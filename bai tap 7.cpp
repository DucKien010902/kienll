//a
class TENode {
public:
    Point* origin;
    double time;
    std::vector<std::pair<TENode*, Shape*>> tgts;
    std::vector<std::pair<TENode*, Shape*>> srcs;
    int key; // New attribute to store a unique identifier for the TENode

    TENode() : origin(nullptr), time(0), key(-1) {} // Initialize key to -1 by default

    TENode(Point* origin, double time, std::vector<std::pair<TENode*, Shape*>> tgts, std::vector<std::pair<TENode*, Shape*>> srcs)
        : origin(origin), time(time), tgts(tgts), srcs(srcs), key(-1) {}

    // Other member functions...
};
//b

class TENode {
public:
    int key;
    std::vector<TENode*> tgts; 
};


void assignKey(TENode *element, int* autoIncreament) {
    
    if (element == nullptr || element->key != -1 || element->tgts.empty()) {
        return;
    }

    
    element->key = *autoIncreament;
    *autoIncreament = *autoIncreament + 1;

    for (auto e : element->tgts) {
        assignKey(e, autoIncreament);
    }
}

//c
void assignKey(TENode *element, int* autoIncreament) {
    if (element == nullptr || element->key != -1 || element->tgts.empty()) {
        return;
    }

    element->key = *autoIncreament;
    *autoIncreament = *autoIncreament + 1;

    for (auto e : element->tgts) {
        assignKey(e, autoIncreament);
    }
}

bool hasDuplicateKeys(const std::vector<TENode*>& graph) {
    std::vector<int> keysSeen;
    for (auto node : graph) {
        if (std::find(keysSeen.begin(), keysSeen.end(), node->key) != keysSeen.end()) {
            return true;
        }
        keysSeen.push_back(node->key);
    }
    return false;
}
//e
void modify(std::vector<std::vector<TENode*>>& graph, std::string shapeName, int number, double... minMiddleMax) {
    double expectedValue = 0.0;
    if (sizeof...(minMiddleMax) == 2) {
        expectedValue = (minMiddleMax[0] + minMiddleMax[1]) / (2 * number);
    } else if (sizeof...(minMiddleMax) == 3) {
        expectedValue = (minMiddleMax[0] + 2 * minMiddleMax[1] + minMiddleMax[2]) / (4 * number);
    } else {
        std::cerr << "Invalid number of arguments for minMiddleMax array!" << std::endl;
        return;
    }

    for (auto& initialization : graph) {
        for (auto node : initialization) {
            // Check srcs
            for (auto& src : node->srcs) {
                if (src->first->name == shapeName) {
                    src->first->time = expectedValue;
                }
            }
            // Check tgts
            for (auto& tgt : node->tgts) {
                if (tgt->first->name == shapeName) {
                    tgt->first->time = expectedValue;
                }
            }
        }
    }
}
//f
void writeFile(std::vector<std::vector<TENode*>>& graph, std::string* fileName) {
    std::ofstream outFile(*fileName);
    if (!outFile) {
        std::cerr << "Error opening file!" << std::endl;
        return;
    }

    // Count the number of vertices and edges
    int numVertices = 0;
    int numEdges = 0;
    for (const auto& initialization : graph) {
        for (const auto& node : initialization) {
            numVertices++;
            for (const auto& tgt : node->tgts) {
                numEdges++;
            }
        }
    }

    // Write the header line
    outFile << "p min " << numVertices << " " << numEdges << std::endl;

    // Write the vertices with non-zero throughput
    for (const auto& initialization : graph) {
        for (const auto& node : initialization) {
            if (node->throughput != 0) {
                outFile << "n " << node->key << " " << node->throughput << std::endl;
            }
        }
    }

    // Write the edges
    for (const auto& initialization : graph) {
        for (const auto& node : initialization) {
            for (const auto& tgt : node->tgts) {
                outFile << "a " << node->key << " " << tgt->first->key << " 0 1 " << tgt->second->cost << std::endl;
            }
        }
    }

    outFile.close();
}
//g
#include <iostream>
#include <fstream>
#include <vector>
#include <string>
#include <tuple>

using namespace std;


int main() {
    vector<vector<TimeExpandedNode*>> graph;
    string fileName = "AllParts.txt";
    double H, v;
    vector<tuple<string, int, double>> fuzzyEdges;


    //b1
    for (const auto& elem : fuzzyEdges) {
        modify(graph, get<0>(elem), get<1>(elem), get<2>(elem));
    }

    // b2
    assertNumberOfNodes(graph);

    // b3
    vector<int> initializations = getStartedNodes(graph);

    // b4
    for (auto index : initializations) {
        spread(graph, 0, index, H, v);
    }

    // b5
    vector<vector<TimeExpandedNode*>> redundants = filter(graph, v);

    //b6
    assertTime(graph);

    // b7
    connectAllChains(graph, points, H, v);

    // b8
    string stations;
    map<string, vector<ArtificialStation>> mapArtificialStations = getTimeWindows("itinerary.txt", &stations);

    // b9
    insertConnectionsForStations(graph, mapArtificialStations);

    // b10
    insertArtificialStationsIntoGraph(graph, mapArtificialStations);

    // b12
    redundants = filter(graph, v);

    // b13
    int autoIncrement = 0;
    for (auto element : initializations) {
        assignKey(element, &autoIncrement);
    }

    //b14
    assertTime(graph);

    //b16
    int totalNodes = 0;
    for (const auto& layer : graph) {
        totalNodes += layer.size();
    }

    // b17
    assert(autoIncrement == totalNodes + 1);
    

    return 0;
}

