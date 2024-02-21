//a

typedef struct {
    char name[10]; 
    char from[10]; 
    char to[10];   
    char shape[100]; 
} Edge;


void printEdge(const Edge *edge) {
    printf("%s\t%s\t%s\t%s\n", edge->name, edge->from, edge->to, edge->shape);
}


//b
void readNetXML(const string& filename, vector<Edge>& edges) {
    ifstream file(filename);
    if (!file.is_open()) {
        cerr << "Error opening file " << filename << endl;
        return;
    }

    string line;
    while (getline(file, line)) {
        if (line.find("<edge") != string::npos) {
            
            Edge edge;
            size_t pos_id = line.find("id=\"") + 4;
            size_t pos_shape = line.find("shape=\"") + 7;

            edge.id = line.substr(pos_id, line.find("\"", pos_id) - pos_id);
            edge.shape = line.substr(pos_shape, line.find("\"", pos_shape) - pos_shape);

            edges.push_back(edge);
        } else if (line.find("<connection") != string::npos) {
            size_t pos_from = line.find("from=\"") + 6;
            size_t pos_to = line.find("to=\"") + 4;
            size_t pos_via = line.find("via=\"") + 5;

            string from = line.substr(pos_from, line.find("\"", pos_from) - pos_from);
            string via = line.substr(pos_via, line.find("\"", pos_via) - pos_via);

            for (auto& edge : edges) {
                if (edge.id == from) {
                    edge.junctions.push_back(via);
                    break;
                }
            }
        }
    }

    file.close();
}

// Function to check if a junction is a crossing type junction
bool isCrossingJunction(const string& junctionId, const vector<Edge>& edges) {
    for (const auto& edge : edges) {
        for (const auto& junc : edge.junctions) {
            if (junc == junctionId) {
                // Check if the edge associated with the junction has a pedestrian disallow lane
                size_t pos = edge.id.find(":");
                if (pos != string::npos) {
                    string edgeId = edge.id.substr(pos);
                    for (const auto& juncEdge : edges) {
                        if (juncEdge.id == edgeId) {
                            for (const auto& lane : juncEdge.shape) {
                                if (lane.find("disallow=\"pedestrian\"") != string::npos) {
                                    return true; // Found a crossing junction
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return false; // Not a crossing junction
}

// Function to print information about edges and crossing junctions
void printEdge2Juncs(const vector<Edge>& edges) {
    for (const auto& edge : edges) {
        cout << edge.id << " " << edge.shape << " ";
        for (const auto& junc : edge.junctions) {
            cout << junc << " ";
            // Print shape of the junction if it is a crossing type junction
            if (isCrossingJunction(junc, edges)) {
                for (const auto& juncEdge : edges) {
                    if (juncEdge.id == junc) {
                        cout << juncEdge.shape << " ";
                    }
                }
            }
        }
        cout << endl;
    }
}

//c

void readNetXML(const string& filename, vector<Edge>& edges) {
    ifstream file(filename);
    if (!file.is_open()) {
        cerr << "Error opening file " << filename << endl;
        return;
    }

    string line;
    while (getline(file, line)) {
        if (line.find("<edge") != string::npos) {
            // Extract edge information
            Edge edge;
            size_t pos_id = line.find("id=\"") + 4;
            size_t pos_from = line.find("from=\"") + 6;
            size_t pos_to = line.find("to=\"") + 4;
            size_t pos_shape = line.find("shape=\"") + 7;

            edge.id = line.substr(pos_id, line.find("\"", pos_id) - pos_id);
            edge.from = line.substr(pos_from, line.find("\"", pos_from) - pos_from);
            edge.to = line.substr(pos_to, line.find("\"", pos_to) - pos_to);
            edge.shape = line.substr(pos_shape, line.find("\"", pos_shape) - pos_shape);

            edges.push_back(edge);
        }
    }

    file.close();
}

// Function to print information about start type edges
void printStart(const vector<Edge>& edges) {
    for (const auto& edge : edges) {
        if (edge.from.find("J") == 0) { // Check if the edge originates from a junction
            // Check if the junction is of type "dead_end"
            size_t pos_type = edge.from.find("type=\"dead_end\"");
            if (pos_type != string::npos) {
                // Print edge information
                cout << edge.id << " " << edge.from << " " << edge.to << " " << edge.shape << endl;
            }
        }
    }
}

//d
void splitStart(double x, const char* name, const vector<Edge>& edges) {
    for (const auto& edge : edges) {
        if (edge.id == name && edge.from.find("J") == 0) { // Check if the edge is of the given name and originates from a junction
            // Split the shape into segments
            vector<string> segments;
            char* token = strtok(const_cast<char*>(edge.shape.c_str()), " ");
            while (token != NULL) {
                segments.push_back(token);
                token = strtok(NULL, " ");
            }

            // Print information about the divided segments
            cout << edge.id << " ";
            double startX = atof(segments[0].c_str());
            double startY = atof(segments[1].c_str());
            for (int i = 0; i < segments.size() - 2; i += 2) {
                double endX = atof(segments[i + 2].c_str());
                double endY = atof(segments[i + 3].c_str());
                double length = sqrt(pow(endX - startX, 2) + pow(endY - startY, 2));
                int numSegments = ceil(length / x);
                double deltaX = (endX - startX) / numSegments;
                double deltaY = (endY - startY) / numSegments;
                for (int j = 0; j < numSegments; ++j) {
                    cout << j << "_";
                    printf("%.2f,%.2f_%.2f,%.2f ", startX, startY, startX + deltaX, startY + deltaY);
                    startX += deltaX;
                    startY += deltaY;
                }
            }
            cout << endl;
            break;
        }
    }
}

//e

string split(double x, char* name, const string& shapeData) {
    string result;
    char* token = strtok(name, "_");
    string prefix = "";
    if (token != NULL) {
        prefix = token;
    }
    int segmentIndex = 0;
    token = strtok(NULL, "_");
    while (token != NULL) {
        int index = atoi(token);
        double startX, startY, endX, endY;
        token = strtok(NULL, "_");
        if (token != NULL) {
            startX = atof(token);
            token = strtok(NULL, ",");
            if (token != NULL) {
                startY = atof(token);
                token = strtok(NULL, "_");
                if (token != NULL) {
                    endX = atof(token);
                    token = strtok(NULL, ",");
                    if (token != NULL) {
                        endY = atof(token);
                    } else {
                        break;
                    }
                } else {
                    break;
                }
            } else {
                break;
            }
        } else {
            break;
        }
        double length = sqrt(pow(endX - startX, 2) + pow(endY - startY, 2));
        if (length <= x) {
            result += prefix + "_" + to_string(segmentIndex) + "_" + to_string(startX) + "," + to_string(startY) + "_" + to_string(endX) + "," + to_string(endY) + " ";
        } else {
            int numSegments = ceil(length / x);
            double deltaX = (endX - startX) / numSegments;
            double deltaY = (endY - startY) / numSegments;
            for (int i = 0; i < numSegments; ++i) {
                result += prefix + "_" + to_string(segmentIndex++) + "_" + to_string(startX) + "," + to_string(startY) + "_";
                startX += deltaX;
                startY += deltaY;
                result += to_string(startX) + "," + to_string(startY) + " ";
            }
        }
        segmentIndex++;
    }
    return result;
}

//f
bool containsKeyword(const std::string& line, const std::string& keyword) {
    return line.find(keyword) != std::string::npos;
}

void printEnd(const std::string& filename) {
    std::ifstream file(filename);
    if (!file.is_open()) {
        std::cerr << "Không th? m? file." << std::endl;
        return;
    }

    std::string line;
    std::vector<std::string> endEdges;
    std::string junctionId;
    bool isDeadEnd = false;

    while (std::getline(file, line)) {
        if (containsKeyword(line, "<junction")) {
            
            if (containsKeyword(line, "type=\"dead_end\"")) {
                isDeadEnd = true;
                
                size_t pos = line.find("id=\"");
                if (pos != std::string::npos) {
                    pos += 4;
                    size_t endPos = line.find("\"", pos);
                    junctionId = line.substr(pos, endPos - pos);
                }
            } else {
                isDeadEnd = false;
            }
        } else if (containsKeyword(line, "<edge")) {
            
            if (isDeadEnd) {
                size_t pos = line.find("to=\"" + junctionId + "\"");
                if (pos != std::string::npos) {
                    pos = line.find("id=\"");
                    if (pos != std::string::npos) {
                        pos += 4;
                        size_t endPos = line.find("\"", pos);
                        std::string edgeId = line.substr(pos, endPos - pos);
                        endEdges.push_back(edgeId);
                    }
                }
            }
        }
    }

    
    std::cout << "Cac edge loai end:" << std::endl;
    for (const std::string& edge : endEdges) {
        std::cout << edge << std::endl;
    }
}

//g
#include <iostream>
#include <fstream>
#include <vector>
#include <string>
#include <set>


struct Edge {
    std::string name;
    std::string shape;
};

struct Junction {
    std::string name;
    std::string shape;
};


std::set<std::string> StartEdges() {
    
}


std::set<std::string> EndEdges() {
    
}


std::vector<Edge> EJ() {
    
}


std::vector<std::string> split(double x, const std::string& name, const std::string& shape) {
    
}


void write(const std::vector<std::string>& parts, std::ofstream& outFile) {
    for (const auto& part : parts) {
        outFile << part << std::endl;
    }
}


void allParts(double x, const std::string& netXmlFile, const std::string& outFile) {
    
    std::vector<Edge> edgesAndJunctions = EJ();
    
    
    std::set<std::string> startEdges = StartEdges();
    std::set<std::string> endEdges = EndEdges();
    
    
    std::ofstream outStream(outFile);
    
    
    std::set<std::string> segmentedParts;
    
    
    std::set<std::string> toBeSegmented = startEdges;
    
    
    while (!toBeSegmented.empty()) {
        
        std::string element = *toBeSegmented.begin();
        toBeSegmented.erase(element);
        
        
        if (endEdges.find(element) == endEdges.end()) {
            
            std::vector<std::string> parts = split(x, element.name, element.shape);
            write(parts, outStream);
            
            
            segmentedParts.insert(element);
            
            
            std::set<std::string> nextElements = getNextElements(element);
            
            
            for (const auto& nextElement : nextElements) {
                if (segmentedParts.find(nextElement) == segmentedParts.end()) {
                    toBeSegmented.insert(nextElement);
                }
            }
        }
    }
    
    
    outStream.close();
}

int main() {
   
    allParts(10.0, "vd13.net.xml", "AllParts.txt");
    
    return 0;
}

