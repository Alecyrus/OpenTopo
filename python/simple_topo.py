'''
    Author: Junkai Huang
    Data: Date: 2016/6/26
'''

import os
import time

import re
import argparse
import json
from Queue import Queue
from pprint import pprint


class SimpleHandle(object):
    def __init__(self, network,connect,handler_file=False):
        self.network_number = network
        self.connect = connect
        self.visited = [0] * (self.network_number+1)
        self.pre = [-1] * (self.network_number+1)
        self.queue = Queue()
        self.handler_file = handler_file
        if(self.handler_file):
            self.data = json.load(file("media/input.json"))
            self.network_number = self.data['netowrk']

        self.topology = {
            "Adjacency":{},
            "Network":[],
            "Router":[],
            "Routing":[]
        }
        self.links = self.generate_adjacency(
            self.network_number,
            self.connect
        )

    def generate_adjacency(self,network_number, connect):
        # create the topology adjacency
        topo_adjacency = [([0] * (network_number + 1)) for i in range(network_number + 1)]
        # save the number of the networks
        topo_adjacency[0][0] = network_number
        #(1,2),(2,3),(3,4),(4,5),(5,6),(6,7),(8,9),(10,11),(11,12),(12,13),(13,14),(14,15),(18,16),(19,16),(17,16),(20,6),(20,6),(3,16),(3,9),(3,7),(9,13)")


        connect = re.sub(';', ',', connect).split(',')

        #pprint(connect)
        #pprint(self.data['connect_weigh'])
        #pprint(len(connect))
        i = 0
        if(self.handler_file):
            while (i < len(connect)):
                pprint(i)
                topo_adjacency[int(connect[i])][int(connect[i + 1])] = self.data['connect_weigh'][i / 2] + 1
                topo_adjacency[int(connect[i + 1])][int(connect[i])] = self.data['connect_weigh'][i / 2] + 1
                i = i + 2
        else:
            while (i < len(connect)):
                #pprint(i)
                topo_adjacency[int(connect[i])][int(connect[i + 1])] = 1
                topo_adjacency[int(connect[i + 1])][int(connect[i])] = 1
                i = i + 2

        #pprint(topo_adjacency)

        topo_ad = {
            'network':self.network_number,
            'topo_adjacency':[]
        }
        topo_ad['topo_adjacency'].append(topo_adjacency)

        self.topology["Adjacency"].update(topo_ad)
        #pprint(self.topology)


        with open('data/adjacency.json','w') as save:
            json.dump(topo_ad, save, sort_keys=True, indent=4)

        return topo_adjacency

    def generate_topology_chart(self, topo):
        max_index = topo[0][0] + 1
        topology_chart = {}

        # write the head of the topology's information
        head = {'categories': [{"name": "Router"}, {"name": "Network"}]}

        # generate the infomation of nodes
        nodes = {'nodes': []}

        for i in xrange(1, max_index):
            name1 = "Router-%d" % i
            value1 = "10.0.100.%d" % i
            category1 = 0
            node1 = {
                'name': name1,
                'value': value1,
                'category': category1
            }
            node11 = {
                'name': name1,
                'port': value1
            }


            if(self.handler_file):
                name2 = str(data['network_name'][i-1])
                value2 = str(data['network_ip'][i-1])
            else:
                name2 = "Network-%d" % i
                value2 = "10.0.%d.0/24" % i
            category2 = 1
            node2 = {
                'name': name2,
                'value': value2,
                'category': category2
            }
            node22 = {
                'name': name2,
                'subnet_segment': value2,
                'gateway':"10.0.%d.1" % i,
                'dns':"8.8.8.8",
                "netmask":"255.255.255.0"
            }

            nodes['nodes'].append(node1)
            self.topology['Router'].append(node11)
            nodes['nodes'].append(node2)
            self.topology['Network'].append(node22)

        links = {'links': []}

        #pprint(self.topology)

        # connect the router and the network
        for i in xrange(0, max_index - 1):
            source = 2 * i
            target = source + 1
            link = {
                'source': source,
                'target': target
            }
            links['links'].append(link)

        for i in xrange(1, max_index):
            for j in xrange(i, max_index):
                if (topo[i][j] > 0):
                    source = 2 * (i - 1)
                    target = 2 * (j - 1)
                    link = {
                        'source': source,
                        'target': target
                    }
                    links['links'].append(link)

        topology_chart.update(head)
        topology_chart.update(nodes)
        topology_chart.update(links)
        #pprint(topology_chart)

        return topology_chart


    def save_topology_chart(self):
        topology_chart = self.generate_topology_chart(
            self.links
        )
        #pprint(topology_chart)
        with open('data/topology_data.json', 'w') as save:
            json.dump(topology_chart, save, sort_keys=True, indent=4)


    def next_hop(self,start,end):
        hop = end
        while self.pre[hop] != start:
            hop = self.pre[hop]
        return hop


    def save_topology_routing(self, type={}):
        max_index = self.network_number + 1
        link = self.links
        #pprint(link)
        router_ip = ['router_ip']
        for i in xrange(1, max_index):
            value1 = "10.0.100.%d" % i
            router_ip.append(value1)

        #pprint(router_ip)

        routing = {
            'routing': []
        }
        # to create routing table for every router
        # every router's routing table includes all the router except the current router
        for start in xrange(1, max_index):
            router_name = "Router_%s" % str(start)
            router = {
                'router_name': router_name,
                'routes': []
            }
            # pprint(start)
            if self.visited[start] == 0:
                self.visited[start] = 1
                self.queue.put(start)
                while self.queue.empty() is False:
                    k = self.queue.get()
                    for j in xrange(1, max_index):
                        if link[k][j] != 0 and self.visited[j] == 0:
                            self.visited[j] = 1
                            self.pre[j] = k
                            self.queue.put(j)
                    if k != start:
                        nexthop = self.next_hop(start, k)
                        # print 'destination %d start %d nexthop %d  ' %(k,start,nexthop)
                        #metric = 0
                        routes = {
                            'destination': router_ip[k],
                            'nexthop': router_ip[nexthop],
                            'metric': link[start][nexthop]
                        }
                        router['routes'].append(routes)

            # pprint(router)
            routing['routing'].append(router)
            for i in xrange(1, max_index):
                self.visited[i] = 0;
                self.pre[i] = -1

        self.topology['Routing'].append(routing["routing"])

        with open('data/entire_topology.json', 'w') as save:
            json.dump(self.topology, save, sort_keys=True, indent=4)
        with open('data/routing_data.json', 'w') as save:
            json.dump(routing, save, sort_keys=True, indent=4)

        return routing


if __name__ == "__main__":
    os.chdir("D:\\phpStudy\\WWW\\opentopo\\python")
    parser = argparse.ArgumentParser()
    parser.add_argument("handler", help="the number of the network",
                        type=int)
    parser.add_argument("-n", "--network", help="the number of the network",
                        type=int)
    parser.add_argument("-c", "--connect", help="the ways of  these network's connections",
                        type=str)
    # parser.add_argument( "-t","--target", help="the target",
    #                     type=int)
    args = parser.parse_args()
    handler = args.handler
    network = args.network
    connect = args.connect
    # target = args.target
    # simple_handle = SimpleHandle(network, connect)
    # simple_handle.save_topology_chart()
    # simple_handle.save_topology_routing()


    #simple_handle = SimpleHandle(5,"(1,2),(2,3),(3,4),(4,5),(5,3),(2,4)")
    #simple_handle = SimpleHandle(20,"(1,2),(2,3),(3,4),(4,5),(5,6),(6,7),(8,9),(10,11),(11,12),(12,13),(13,14),(14,15),(18,16),(19,16),(17,16),(20,6),(20,6),(3,16),(3,9),(3,7),(9,13)")
    if(handler == 1):
        simple_handle = SimpleHandle(network, connect)
        simple_handle.save_topology_chart()
        simple_handle.save_topology_routing()

    if(handler == 2):
        data = json.load(file("media/input.json"))
        #pprint(data['netowrk'])
        #pprint(str(data['connect']))
        simple_handle = SimpleHandle(
                        int(data['netowrk']),
                        str(data['connect']),
                        True
        )
        simple_handle.save_topology_chart()
        simple_handle.save_topology_routing()
        with open("media/input.json","w") as clr:
            clr.truncate()
        # pprint(data['connect_weigh'])
        # pprint(data['network_ip'])
    print("Finished!")


