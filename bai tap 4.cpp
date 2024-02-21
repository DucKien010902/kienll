//a
class Point {
public:
    double x, y;
};

class TimeExpandedNode {
public:
    Point* origin;
    double time;
};

// Hàm getChains
std::vector<std::tuple<int, int, double>> getChains(std::vector<std::vector<TimeExpandedNode*>> graph, Point* origin) {
    std::vector<std::tuple<int, int, double>> chains; // Vector ch?a k?t qu?

    
    for (int i = 0; i < graph.size(); ++i) {
    
        for (int j = 0; j < graph[i].size(); ++j) {
            
            if (graph[i][j]->origin == origin) {
                
                chains.push_back(std::make_tuple(i, j, graph[i][j]->time));
            }
        }
    }

    
    std::sort(chains.begin(), chains.end(), [](const auto& a, const auto& b) {
        return std::get<2>(a) < std::get<2>(b);
    });

    return chains;
}

//b
std::vector<std::pair<int, double>> 
createNewChains(std::vector<std::tuple<int, int, double>> oldChains,
           std::vector<std::vector<TimeExpandedNode*>> graph, 
           double H, double deltaT){
	int count = 0, steps = 0;
	int oldSize = oldChains.size( );
	int fixedIndex = oldChains.at(0).get<1>();
	std::vector<std::pair<int, double>> newChains;

	while(count < oldSize - 1){
		auto prev = oldChains.at(count);
		auto next = oldChains.at(count + 1);
		steps = 0;
		if(prev.get<2>( ) < next.get<2>( ) - deltaT){
			steps = floor((next.get<2>( )  - prev.get<2>( ))/deltaT);
			size = newChains.size( );
			for(int i = 0; i < steps; i++){
				newChains.push_back(std::make_pair(i + size, 
									prev.get<2>() + deltaT*(i+1)));
			}
		}
		count++;
	}
	auto last = oldChains.at(oldSize - 1);
	steps = floor((H - last.get<2>( ))/deltaT);
	size = newChains.size( ) + oldChains.size( );
	for(int i = 0; i < steps; i++){
		newChains.push_back(std::make_pair(i + size, last.get<2>() + deltaT*(1 + i)));
	}
	return newChains;
}

//c

std::vector<std::pair<int, int>> insert(std::vector<std::vector<TimeExpandedNode*>> graph, 
	std::vector<std::pair<int, double>> newChains, 
		TimeExpandedNode* p){
std::vector<std::pair<int, int>> result;
	for(auto elem : newChains){
		if(isAvailable(graph, p->origin, elem->second)){
			continue;
		}
		TimeExpandedNode* newNode = new TimeExpandedNode(p->origin,
								elem->second,
								p->tgts);

		if(graph.size( ) <= elem.first){
			std::vector<TimeExpandedNode*> v{newNode};
			graph.push_back(v);
			result.push_back(std::make_pair(graph.size( ) - 1, 0));
		}
		else{
			auto currVector = graph.at(elem.first);
			if(currVector.size( ) == 0){
				graph.at(elem.first).push_back(newNode);
				result.push_back(std::make_pair(elem.first, 
						  		       graph.at(elem.first).size( ) -1)));
			}
			else if(currVector.at(0).time == elem.second){
				graph.at(elem.first).push_back(newNode);
				result.push_back(std::make_pair(elem.first, 
						  		       graph.at(elem.first).size( ) -1)));
			}
			else{
				std::vector<TimeExpandedNode*> v{newNode};
				graph.insert(graph.begin( ) + elem.first,
						1, v);
				result.push_back(std::make_pair(elem.first, 0));
			}
		}
	}
	return result;
}

bool checkInsertion(std::vector<std::vector<TimeExpandedNode*>> graph, 
	std::vector<std::pair<int, double>> newChains, 
		TimeExpandedNode* p){
	for(auto elem : newChains){
		if(!isAvailable(graph, p->origin, elem->second)){
			return false;
		}
	}
	return true;
}

bool checkResult(std::vector<std::vector<TimeExpandedNode*>> graph, 
	std::vector<std::pair<int, double>> newChains, 
		std::vector<std::pair<int, int>> newPositions,
		TimeExpandedNode* p){
int i = 0;
	for(auto elem : newChains){
		pos = newPositions.at(i);
		if(!graph.at(pos.first).at(pos.second)->origin.equals(p->origin) || 
			graph.at(pos.first).at(pos.second).time != elem.second
			){
			return false;
		}
		i++;
	}
	return true;
}
//d
std::vector<std::pair<int, int>>  merge(std::vector<std::tuple<int, int, double>> oldChains,
						std::vector<std::pair<int, int>> newChains){
	int count = 0, i = 0, j = 0;
	std::vector<std::pair<int, int>> result ;
	int sizeOld = oldChains.size( ), sizeNew = newChains.size( );
	int size = oldChains.size( ) + newChains.size( );
	while(count < size && i < sizeOld && j < sizeNew){
		if(oldChains.at(i).first < newChains.at(j).first){
			result.push_back(std::make_pair(i, oldChains.at(i).second));
			i++;
		}
		else if(oldChains.at(i).first > newChains.at(j).first){
			result.push_back(std::make_pair(j, newChains.at(j).second));
			j++;
		}
		else{ 
			result.push_back(std::make_pair(i, oldChains.at(i).second));
			i++; j++;
		}
		count++;
	}
	return result;
}

//e
PausingShape( ){ d = 0; name = “artificial”; time = 0;}
PausingShape(double time) {
	this.time = time;
            name = “artificial”; 
}
PausingShape(Shape *s, std::string name){
            strcpy(this->name.c_str(), name.c_str());
            this->start = s->start;
            this->end = s->end;
            this->d = s->d;
            this->time = s->getTime( );
}

double getTime( ){
            return this->time;
}

//f
class TimeExpandedNode {
public:
    double time;
    std::vector<std::pair<TimeExpandedNode*, Shape*>> srcs;
    std::vector<std::pair<TimeExpandedNode*, Shape*>> tgts;
};

// Hàm connectChains
std::vector<std::vector<TimeExpandedNode*>> connectChains(
    std::vector<std::vector<TimeExpandedNode*>> graph,
    std::vector<std::pair<int, int>> newOrder) {
    
    for (int i = 0; i < newOrder.size() - 1; ++i) {
        int i1Prev = newOrder[i].first;
        int i2Prev = newOrder[i].second;
        int j1Next = newOrder[i + 1].first;
        int j2Next = newOrder[i + 1].second;

        TimeExpandedNode* prev = graph[i1Prev][i2Prev];
        TimeExpandedNode* next = graph[j1Next][j2Next];

        
        double tempTime = next->time - prev->time;
        Shape* s0 = new PausingShape(tempTime);
        s0->start = prev;
        s0->end = next;

        
        prev->tgts.push_back(std::make_pair(next, s0));
        next->srcs.push_back(std::make_pair(prev, s0));
    }
    return graph;
}
//g
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
    for (auto index : initializations) {
        // T?o chu?i m?i t? các chu?i hi?n có và m? r?ng d? th?
        createNewChainsAndSpread(graph, initializations, H, v);
    }

    // B9
    redundants = filter(graph, v);
   

    // B10
    assertTime(graph);

    // B12
    int totalNodes = 0;
    for (const auto& layer : graph) {
        totalNodes += layer.size();
    }
    cout << "Total number of nodes in the graph: " << totalNodes << endl;

    return 0;
}


