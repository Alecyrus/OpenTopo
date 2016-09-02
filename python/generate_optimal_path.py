'''
    Author: Junkai Huang
    Data: Date: 2016/6/26
'''
import os
from pprint import pprint


import re
import json
import argparse
from collections import defaultdict
from heapq import *

class Dijkstra(object):
    def __init__(self):
        data = json.load(file("data/adjacency.json"))
        self.links = data["topo_adjacency"][0]
        self.network_number = data["network"]
        pprint(self.links)

    @staticmethod
    def generate_adjacency(network_number, connect):
        # create the topology adjacency
        topo_adjacency = [([0] * (network_number + 1)) for i in range(network_number + 1)]
        # save the number of the networks
        topo_adjacency[0][0] = network_number
        # 1,2;2,3;3,4;4,5;5,6;6,7;8,9;10,11;11,12;12,13;13,14;14,15;18,16;19,16;17,16;20,6;20,6;3,16;3,9;3,7;9,13


        connect = re.sub(';', ',', connect).split(',')

        #pprint(connect)
        #pprint(len(connect))

        i=0
        while(i<len(connect)):
            topo_adjacency[int(connect[i])][int(connect[i+1])] = 1
            topo_adjacency[int(connect[i+1])][int(connect[i])] = 1
            i = i + 2

        #pprint(topo_adjacency)
        return topo_adjacency

    @staticmethod
    def dijkstra_raw(edges, from_node, to_node):
        g = defaultdict(list)
        for l, r, c in edges:
            g[l].append((c, r))

        q, seen = [(0, from_node, ())], set()
        while q:
            (cost, v1, path) = heappop(q)
            if v1 not in seen:
                seen.add(v1)
                path = (v1, path)
                if v1 == to_node:
                    return cost, path
                for c, v2 in g.get(v1, ()):
                    if v2 not in seen:
                        heappush(q, (cost + c, v2, path))
        return float("inf"), []


    @staticmethod
    def dijkstra(edges, from_node, to_node):
        len_shortest_path = -1
        ret_path = []

        length, path_queue = Dijkstra.dijkstra_raw(edges, from_node, to_node)
        if len(path_queue) > 0:
            len_shortest_path = length
            left = path_queue[0]
            ret_path.append(left)
            right = path_queue[1]
            while len(right) > 0:
                left = right[0]
                ret_path.append(left)
                right = right[1]
            ret_path.reverse()

        return len_shortest_path, ret_path

    def generate_optimal_path(self, source, target):
        link = self.links

        pprint(link)
        # MAX means thats there is not any connection between source and target
        MAX = 99999
        topo_map = [([0] * self.network_number) for i in range(self.network_number)]
        for i in xrange(1, self.network_number + 1):
            for j in xrange(i, self.network_number + 1):
                if link[i][j] == 0:
                    topo_map[i - 1][j - 1] = MAX
                    topo_map[j - 1][i - 1] = MAX
                else:
                    topo_map[i - 1][j - 1] = link[i][j] - 1
                    topo_map[j - 1][i - 1] = link[i][j] - 1
        pprint(topo_map)

        edges = []
        for i in range(len(topo_map)):
            for j in range(len(topo_map[0])):
                if i != j and topo_map[i][j] != MAX:
                    edges.append((i, j, topo_map[i][j]))

        #length, Shortest_path = Dijkstra.dijkstra(edges, source, target)
        #print 'weigth = ', length
       # print ' the optimal path is ', Shortest_path

        return Dijkstra.dijkstra(edges, source, target)



if __name__ == "__main__":
    os.chdir("D:\\phpStudy\\WWW\\opentopo\\python")
    parser = argparse.ArgumentParser()

    parser.add_argument("source", help="the source",
                        type=int)
    parser.add_argument("target", help="the target",
                        type=int)
    args = parser.parse_args()
    source = args.source-1
    target = args.target-1

    dj = Dijkstra()
    length, Shortest_path = dj.generate_optimal_path(source, target)

    for i in xrange(len(Shortest_path)):
        Shortest_path[i] = "Router-%s " %str(Shortest_path[i] + 1)
    ssource = "Network-%s" %str(source+1)
    ttarget= "Network-%s" %str(target+1)
    Shortest_path.insert(0, ssource)
    Shortest_path.insert(len(Shortest_path), ttarget)

    os.chdir("D:\\phpStudy\\WWW\\opentopo\\php")
    if(length >= 0):
        path = re.sub(',', '-->', str(Shortest_path))[1:-1]
        with open('path_data.json', 'w') as save:
            json.dump("Metric: "+str(length)+"...................."+"Path: "+path, save, sort_keys=True, indent=4)

    else:
        path = ""
        with open('path_data.json', 'w') as save:
            json.dump("ERROR: please check your input,OK?", save, sort_keys=True, indent=4)

    pprint(path)


