//a
class TimeExpandedNode {
public:
    std::vector<std::pair<TimeExpandedNode*, Shape*>> srcs;
    Point* origin;
    double time;
    int layer;
    std::vector<std::pair<TimeExpandedNode*, Shape*>> tgts;

    
    TimeExpandedNode() {}

    // Phuong th?c kh?i t?o có tham s
    TimeExpandedNode(Point* origin, double time, std::vector<std::pair<TimeExpandedNode*, Shape*>> tgts) {
        this->origin = origin;
        this->time = time;
        for (auto it : tgts) {
            this->tgts.push_back(std::make_pair(nullptr, it.second));
        }
    }

    
    int indexInSources(Shape* s) {
        int index = 0;
        bool found = false;
        for (auto it : srcs) {
            Shape* shape = it.second;
            if (shape->equals(s)) {
                found = true;
                return index;
            }
            index++;
        }
        if (!found) return -1;
        return index;
    }
};
//b

class TimeExpandedNode {
public:
    Point* origin;
    double time;

   
    bool highlyEquals(Point* p) {
        return (this->origin->x == p->x && this->origin->y == p->y && this->time == p->time);
    }
};

TimeExpandedNode* isAvailable(std::vector<std::vector<TimeExpandedNode*>> graph, Point* origin, double time) {
    for (const auto& layer : graph) {
        for (auto node : layer) {
            if (node->origin->highlyEquals(origin) && node->time == time) {
                return node;
            }
        }
    }
    return nullptr;
}
//c
bool isAvailable(std::vector<std::vector<TimeExpandedNode*>>& graph, double time, int *index) {
    
    for (int i = 0; i < graph.size(); ++i) {
        
        if (!graph[i].empty() && graph[i][0]->time == time) {
            
            *index = i;
            return true;
        }
    }
    
    graph.push_back(std::vector<TimeExpandedNode*>());
    
    *index = graph.size() - 1;
   
    return false;
}
//d
void insert(std::vector<std::vector<TimeExpandedNode*>>& graph, TimeExpandedNode *ten) {
   
    int index = 0;
    while (index < graph.size() && graph[index][0]->time < ten->time) {
        ++index;
    }
    
    
    if (index < graph.size() && graph[index][0]->time == ten->time) {
        
        graph[index].push_back(ten);
    } else {
        
        std::vector<TimeExpandedNode*> newVector;
        newVector.push_back(ten);
        graph.insert(graph.begin() + index, newVector);
    }
}
//e

class Constant {
public:
    static const double v; 
};

const double Constant::v = 10.0; /

class Shape {
protected:
    double d; 
    double time = 0; 

public:
    
    virtual double getWeight() {
        if (time == 0) {
            time = d / Constant::v;
        }
        return time;
    }

    
    Shape(double distance) : d(distance) {}
};


class Circle : public Shape {
public:
    
    Circle(double radius) : Shape(radius * 2) {} 

    
    double getWeight() override {
        
        return Shape::getWeight() * 1.5; 
    }
};

//f
void spread(std::vector<std::vector<TimeExpandedNode*>> graph, int m, int n, double H){
         TimeExpandedNode* node = graph.at(m).at(n);
         std:queue<TimeExpandedNode*> Q;
         Q.push(node );
         while(!Q.empty()){
                   TimeExpandedNode* temp = Q.pop( );
                   for(auto pair in temp->tgts){
                              auto s = pair.second; 
                              double time = temp->time + s->getTime( );
                              if(time < H){
                                        auto origin = s->end;  auto n = pair.first;
                                        auto foundItem = isAvailable(graph, origin, time);
                                        if(foundItem == null){
                                                  TimeExpandedNode* newNode = 
                                                                  new TimeExpandedNode(origin, time, n->tgts);
                                                  pair.first = newNode;
                                                  foundItem = newNode;
                                        }
                                        int index = foundItem->indexInSources(s);
                                        if(index != -1){
                                                  foundItem->srcs.at(index).first = temp;
                                        }
                                        else{
                                                  foundItem->srcs.push_back(std::make_pair(temp, s));
                                        }
                                        insert(graph, foundItem);
                                        Q.push(foundItem);
                              }
                   }
         }
}
//e
std::vector<std::pair<int, int>> filter(std::vector<std::vector<TimeExpandedNode*>> graph, double v) {
    std::vector<std::pair<int, int>> result;

    for (int u = 0; u < graph.size(); ++u) {
        for (int v = 0; v < graph[u].size(); ++v) {
            TimeExpandedNode* Uv = graph[u][v];

            
            if (Uv && !Uv->srcs.empty()) {
                for (auto& pair : Uv->srcs) {
                    TimeExpandedNode* n = pair.first;
                    Shape* s = pair.second;

                    
                    if (n->time + s->getWeight() > Uv->time) {
                        result.push_back(std::make_pair(u, v));
                        break; 
                    }
                }
            }
        }
    }

    return result;
}
//f

void remove(std::vector<std::pair<int, int>> filters, std::vector<std::vector<TimeExpandedNode*>>& graph) {
    for (const auto& filter : filters) {
        int u = filter.first;
        int v = filter.second;

        
        if (u >= 0 && u < graph.size() && v >= 0 && v < graph[u].size()) {
            delete graph[u][v]; 
            graph[u][v] = nullptr; 
        }
    }
}

//g

class Point {
public:
    double x, y;
};

class TimeExpandedNode {
public:
    std::vector<std::pair<TimeExpandedNode*, int>> srcs;
    Point* origin;
    double time;
    int layer;
    std::vector<std::pair<TimeExpandedNode*, int>> tgts;
};

// Hàm getStartedNodes
std::vector<int> getStartedNodes(std::vector<std::vector<TimeExpandedNode*>> graph) {
    std::vector<int> result;

    
    for (int i = 0; i < graph.size(); ++i) {
       
        for (int j = 0; j < graph[i].size(); ++j) {
            TimeExpandedNode* node = graph[i][j];
            
            if (node->time == 0 && node->srcs.empty()) {
                result.push_back(j); 
            }
        }
    }

    return result;
}
//h

class TimeExpandedNode {
public:
    std::vector<std::pair<TimeExpandedNode*, double>> srcs;
    double time;
};

// Hàm assertTime
void assertTime(std::vector<TimeExpandedNode*> graph, double v) {
    
    for (TimeExpandedNode* node : graph) {
        
        if (!node->srcs.empty()) {
            
            for (auto elem : node->srcs) {
                
                assert(elem.first->time + elem.second == node->time);
            }
        }
    }
}

//i
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
    readAllParts(fileName, graph);

    // B2
    assertNumberOfNodes(graph);

    // B3
    vector<int> initializations = getStartedNodes(graph);

    // B4
    for (auto index : initializations) {
        spread(graph, 0, index, H, v);
    }

    // B5
    vector<vector<TimeExpandedNode*>> redundants = filter(graph, v);
    

    // B6
    assertTime(graph);

    // B8
    int totalNodes = 0;
    for (const auto& layer : graph) {
        totalNodes += layer.size();
    }
    cout << "Total number of nodes in the graph: " << totalNodes << endl;

    return 0;
}

