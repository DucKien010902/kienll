//a
class Shape {
public:
    std::string name;
};

class TimeExpandedNode {
public:
    std::vector<std::pair<TimeExpandedNode*, Shape*>> tgts;
    std::vector<std::pair<TimeExpandedNode*, Shape*>> srcs;
    
    bool endOfLane() {
        if (this->tgts.size() <= 1) return true;
        
        for (int i = 0; i < this->srcs.size(); i++) {
            auto shape = this->srcs.at(i).second;
            auto name = shape->name;
            if (name.compare("artificial") != 0) {
                for (int j = 0; j < this->tgts.size(); j++) {
                    auto nextShape = this->tgts.at(j).second;
                    auto nextName = nextShape->name;
                    if (nextName.compare("artificial") != 0) {
                        if (nextName.compare(name) != 0) {
                            return true;
                        }
                    }
                }
            }
        }
        
        return false;
    }
};
//b
class Shape {
public:
    std::string name;
};

class TimeExpandedNode {
public:
    std::vector<std::pair<TimeExpandedNode*, Shape*>> tgts;
    std::vector<std::pair<TimeExpandedNode*, Shape*>> srcs;
    
    std::string isStation(std::string stations) {
        for (int i = 0; i < this->srcs.size(); i++) {
            auto shape = this->srcs.at(i).second;
            auto name = shape->name;
            if (name.compare("artificial") != 0) {
                if (stations.find("$" + name + "$") != std::string::npos) {
                    return name;
                }
            }   
        }
        return "";
    }
};
//c
class Shape {
public:
    std::string name;
};

class TENode {
public:
    std::vector<std::pair<TENode*, Shape*>> tgts;
    std::vector<std::pair<TENode*, Shape*>> srcs;
    std::string name = "";

    bool endOfLane() {
        if (this->tgts.size() <= 1) return true;
        for (int i = 0; i < this->srcs.size(); i++) {
            auto shape = this->srcs.at(i).second;
            auto name = shape->name;
            if (name.compare("artificial") != 0) {
                for (int j = 0; j < this->tgts.size(); j++) {
                    auto nextShape = this->tgts.at(j).second;
                    auto nextName = nextShape->name;
                    if (nextName.compare("artificial") != 0) {
                        if (nextName.compare(name) != 0) {
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    std::string isStation(std::string stations) {
        for (int i = 0; i < this->srcs.size(); i++) {
            auto shape = this->srcs.at(i).second;
            auto name = shape->name;
            if (name.compare("artificial") != 0) {
                if (stations.find("$" + name + "$") != std::string::npos) {
                    return name;
                }
            }
        }
        return "";
    }
};

class Station : public TENode {
public:
    Station() : TENode() {}

    Station(TENode* temp, std::string name) : TENode() {
        this->srcs = temp->srcs;
        this->name = name;
        this->tgts = temp->tgts;
        this->origin = temp->origin;
        this->time = temp->time;
        for (auto pr : this->srcs) {
            for (auto pt : pr->tgts) {
                if (pt->first == temp) {
                    pt->first = this;
                }
            }
        }
        for (auto pr : this->tgts) {
            for (auto pt : pr->srcs) {
                if (pt->first == temp) {
                    pt->first = this;
                }
            }
        }
    }
};

void replaceStation(std::vector<std::vector<TENode*>>& graph, std::string stations) {
    for (int i = 0; i < graph.size(); i++) {
        auto v = graph.at(i);
        for (int j = 0; j < v.size(); j++) {
            auto temp = v.at(j);
            if (temp->endOfLane()) {
                auto name = temp->isStation(stations);
                if (!name.empty()) {
                    graph.at(i).at(j) = new Station(temp, name);
                }
            }
        }
    }
}
//d
class TimeExpandedNode;

class TENode {
public:
    virtual TimeExpandedNode* transform(TimeExpandedNode* node) {
        return this;
    }

    virtual void connect2ArtificialStation(TimeExpandedNode* node) {}
};
//e

class ArtificialStation : public Station {
private:
    double bestTime;
    double amplitude;
    double earliness;
    double tardiness;

public:
    ArtificialStation(std::string name, double bestTime, double amplitude) : Station(name), bestTime(bestTime), amplitude(amplitude) {
        this->earliness = bestTime - amplitude;
        this->tardiness = bestTime + amplitude;
    }

    // Override transform method
    TimeExpandedNode* transform(TimeExpandedNode* node) override {
        // Your implementation goes here
    }
};
//f

std::map<std::string, std::vector<ArtificialStation*>> getTimeWindows(std::string fileName, double H, std::string *stations) {
    std::map<std::string, std::vector<ArtificialStation*>> result;
    std::ifstream file(fileName);
    std::string line;
    while (std::getline(file, line)) {
        std::istringstream iss(line);
        std::string routeName, startRoad, endRoad, junction, endJunction;
        double bestTime, amplitude;
        int period;
        if (!(iss >> routeName >> startRoad >> endRoad >> junction >> endJunction >> period >> bestTime >> amplitude)) {
            break; // Error reading line, break the loop
        }
        std::vector<ArtificialStation*> values;
        for (int i = 0; i < H; i += period) {
            values.push_back(new ArtificialStation(junction, bestTime + i, amplitude));
        }
        if (!values.empty()) {
            result[routeName] = values;
            *stations += "$" + junction + "$";
        }
    }
    return result;
}
//g

class ArtificialShape : public PausingShape {
public:
    ArtificialShape(double time) : PausingShape(time) {}
    
    // Overriding the getTime method
    double getTime() override {
        return this->time;
    }
};
//h

void ArtificialStation::createConnection(TimeExpandedNode* node) {
    if (typeid(*node) == typeid(Station) && typeid(*this) != typeid(ArtificialStation)) {
        Station* stationNode = dynamic_cast<Station*>(node); // Downcast to Station
        if (this->name == stationNode->name) {
            double penaltyT = std::max(this->earliness - node->time, 0.0);
            penaltyT = std::max(penaltyT, node->time - this->tardiness);
            ArtificialShape* aShape = new ArtificialShape(penaltyT);
            node->tgts.push_back(std::make_pair(this, aShape));
            this->srcs.push_back(std::make_pair(node, aShape));
        }
    }
}
//k
#include <iostream>
#include <vector>
#include <string>
#include <fstream>



void printNumberOfTENodes(const std::vector<std::vector<TimeExpandedNode*>>& graph) {
    int count = 0;
    for (const auto& vec : graph) {
        count += vec.size();
    }
    std::cout << "Number of TENodes in the graph: " << count << std::endl;
}

int main() {
    // B1
    std::vector<std::vector<TimeExpandedNode*>> graph = readAllParts("AllParts.txt");
    
    // B2
    checkB1(graph);
    
    // B3
    std::vector<int> initializations = getStartedNodes(graph);
    
    // B4
    double H, v; // Khai báo H và v
    for (auto index : initializations) {
        spread(graph, 0, index, H, v);
    }
    
    // B5
    filterGraph(graph, v);
    
    // B6
    checkB2();
    
    
    // B8
    std::vector<Point> points; // Khai báo points
    connectAllChains(graph, points, H, v);
    
    // B9
    std::vector<ArtificialStation> mapArtificialStations;
    std::string stations; // Khai báo stations
    getTimeWindows("itinerary.txt", stations, mapArtificialStations);
    
    // B10
    for (int i = 0; i < graph.size(); i++) {
        auto v = graph.at(i);
        for (int j = 0; j < v.size(); j++) {
            auto temp = v.at(j);
            if (instanceof<Station>(temp)) {
                std::string name = temp->name;
                auto foundit = mapArtificialStations.find(name);
                if (foundit != mapArtificialStations.end()) {
                    auto allArStations = mapArtificialStations[name];
                    for (auto elem : allArStations) {
                        elem.createConnection(temp);
                    }
                }
            }
        }
    }
    
    // B11
    for (const auto& el : mapArtificialStations) {
        auto v = el.second;
        for (auto elem : v) {
            insert(graph, elem);
        }
    }
    
    // B12
    filterGraph(graph, v);
    
    
    
    
    
    // B15
    printNumberOfTENodes(graph);
    
    return 0;
}

