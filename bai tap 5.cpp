//a
class TimeExpandedNode {
public:
    Point* origin;
    double time;
};

class Point {
public:
    double x, y;
};

// Hàm isAvailable
TimeExpandedNode* isAvailable(std::vector<std::vector<TimeExpandedNode*>>& graph, Point* origin) {
    TimeExpandedNode* result = nullptr;
    double minTime = std::numeric_limits<double>::max();

    for (const auto& vec : graph) {
    
        for (TimeExpandedNode* node : vec) {
        
            if (node->origin == origin) {
            
                if (node->time < minTime) {
                    result = node;
                    minTime = node->time;
                }
            }
        }
    }
    return result;
}
//b

class TimeExpandedNode {
public:
    Point* origin;
    double time;
};

class Point {
public:
    double x, y;
};

// Hàm connectAllChains
std::vector<std::vector<TimeExpandedNode*>> connectAllChains(
    std::vector<std::vector<TimeExpandedNode*>>& graph,
    std::vector<Point*>& points,
    double H,
    double v
) {
    for (auto origin : points) {
        
        auto chains = getChains(graph, origin);
        
        auto newChains = createNewChains(chains, graph, H);
        
        auto temp = isAvailable(graph, origin);
        auto newPos = insert(graph, newChains, temp);
       
        assert(checkInsertion(graph, newChains, temp)); 
        assert(checkResult(graph, newChains, newPos, temp));
        
        for (auto elem : newPos) {
            spread(graph, elem.first, elem.second, H, v);
        }
       
        auto newOrder = merge(chains, newPos);
        connectChains(graph, newOrder);
    }
    return graph;
}
//c
#include <iostream>
#include <fstream>
#include <vector>
#include <string>
#include <cassert>

using namespace std;

int main() {
    vector<vector<TimeExpandedNode*>> graph;
    string fileName = "AllParts.txt";
    double H, v;

    // B1
    vector<int> points;
    readAllParts(fileName, graph);
    for (const auto& layer : graph) {
        for (const auto& node : layer) {
            points.push_back(node->origin);
        }
    }

    // B2
    assertNumberOfNodes(graph);

    // B3
    vector<int> initializations = getStartedNodes(graph);
    vector<int> nonStartedPoints;
    for (const auto& point : points) {
        if (find(initializations.begin(), initializations.end(), point) == initializations.end()) {
            nonStartedPoints.push_back(point);
        }
    }

    // B4
    for (auto index : initializations) {
        spread(graph, 0, index, H, v);
    }

    // B5
    vector<vector<TimeExpandedNode*>> redundants = filter(graph, v);
    // remove(redundants, graph);

    // B7
    assertTime(graph);

    // B8
    connectAllChains(graph, nonStartedPoints, H, v);

    // B9
    redundants = filter(graph, v);
    // remove(redundants, graph);

    // B11
    assertTime(graph);

    // B12
    int totalNodes = 0;
    for (const auto& layer : graph) {
        totalNodes += layer.size();
    }
    cout << "Total number of nodes in the graph: " << totalNodes << endl;

    return 0;
}

