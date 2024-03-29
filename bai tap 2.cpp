//a
class Point{
public:
    double x, y;
    bool equals(Point* p){
        return (this->x == p->x && this->y == p->y);
    }
};


class Shape{
public:
    Point* start;
    Point* end;
    double d;
    std::string name;
    bool equals(Shape* s){
        return (this->start->equals(s->start) && this->end->equals(s->end));
    }
};


class TimeExpandedNode{
public: 
    std::vector<std::pair<TimeExpandedNode*, Shape*>> srcs;
    Point* origin;
    double time;
    int layer;
    std::vector<std::pair<TimeExpandedNode*, Shape*>> tgts;
    
    
    void insertSource(Shape* s){
        bool found = false;
        for(auto& pair : srcs){
            if(pair.first == nullptr && pair.second->start->equals(s->start)){
                found = true;
                break;
            }
        }
        if(!found){
            srcs.push_back(std::make_pair(nullptr, s));
        }
    }

    void insertTarget(Shape* s){
        bool found = false;
        for(auto& pair : tgts){
            if(pair.first == nullptr && pair.second->end->equals(s->end)){
                found = true;
                break;
            }
        }
        if(!found){
            tgts.push_back(std::make_pair(nullptr, s));
        }
    }

    
    bool equals(TimeExpandedNode* n){
        return this->origin->equals(n->origin);
    }

    void insertSourcesAndTargets(TimeExpandedNode* n, std::vector<std::pair<int, int>> fromN,
                                    std::vector<std::pair<int, int>> toN)
    {
        for(auto& pair : fromN){
            int atN = pair.first;
            int toThis = pair.second;
            if(this->srcs.at(atN).first == nullptr){
                this->srcs.at(atN).first = n;
            }
            if(n->tgts.at(toThis).first == nullptr){
                n->tgts.at(toThis).first = this;
            }
        }

        for(auto& pair : toN){
            int atN = pair.first;
            int fromThis = pair.second;
            if(this->tgts.at(fromThis).first == nullptr){
                this->tgts.at(fromThis).first = n;
            }
            if(n->srcs.at(atN).first == nullptr){
                n->srcs.at(atN).first = this;
            }
        }
    }
};

void buildGraph(const std::string& filename, std::map<std::string, TimeExpandedNode*>& graph){
    std::ifstream file(filename);
    if(!file){
        std::cerr << "Error: Unable to open file " << filename << std::endl;
        return;
    }

    std::string line;
    while(std::getline(file, line)){
        std::istringstream iss(line);
        std::string shapeName, startPoint, endPoint;
        double distance;

        if(!(iss >> shapeName >> startPoint >> endPoint >> distance)){
            std::cerr << "Error: Invalid line format: " << line << std::endl;
            continue;
        }

        Point* start = new Point();
        Point* end = new Point();
        sscanf(startPoint.c_str(), "%lf_%lf", &start->x, &start->y);
        sscanf(endPoint.c_str(), "%lf_%lf", &end->x, &end->y);

        Shape* shape = new Shape();
        shape->name = shapeName;
        shape->start = start;
        shape->end = end;
        shape->d = distance;

        if(graph.find(startPoint) == graph.end()){
            TimeExpandedNode* node = new TimeExpandedNode();
            node->origin = start;
            graph[startPoint] = node;
        }

        if(graph.find(endPoint) == graph.end()){
            TimeExpandedNode* node = new TimeExpandedNode();
            node->origin = end;
            graph[endPoint] = node;
        }

        graph[startPoint]->insertSource(shape);
        graph[endPoint]->insertTarget(shape);
    }

    file.close();
}

std::vector<std::pair<Shape*, Shape*>> findNeighbors(const std::map<std::string, TimeExpandedNode*>& graph){
    std::vector<std::pair<Shape*, Shape*>> neighbors;

    for(const auto& pair1 : graph){
        for(const auto& pair2 : graph){
            if(pair1.first != pair2.first){
                for(const auto& src1 : pair1.second->srcs){
                    for(const auto& tgt2 : pair2.second->tgts){
                        if(src1.second->equals(tgt2.second)){
                            neighbors.push_back(std::make_pair(src1.second, tgt2.second));
                        }
                    }
                }
            }
        }
    }

    return neighbors;
}
//b
struct Point {
    double x;
    double y;
};

struct Shape {
    Point start;
    Point end;
    std::string name;
};

struct TimeExpandedNode {
    std::vector<std::pair<TimeExpandedNode*, Shape*>> srcs;
    std::vector<std::pair<TimeExpandedNode*, Shape*>> tgts;
    Point origin;
    int time;
};

// Hàm đọc file AllParts.txt và xây dựng danh sách các TE-Node ở tầng số 0
std::vector<TimeExpandedNode*> readAllParts(const std::string& filename) {
    std::ifstream file(filename);
    if (!file.is_open()) {
        // Xử lý lỗi mở file
    }

    std::set<Point> P;
    std::set<Shape> S;
    std::vector<TimeExpandedNode*> allTENs;

    std::string line;
    while (std::getline(file, line)) {
        std::string nameOfShape = getName(line);
        int index = getIndex(line);
        Point firstPoint = getFirstPoint(line);
        Point lastPoint = getLastPoint(line);
        Shape shape = getShape(firstPoint, lastPoint, line);

        if (!P.count(firstPoint)) {
            P.insert(firstPoint);
            TimeExpandedNode* n1 = getTENode(firstPoint);
            allTENs.push_back(n1);
        }

        if (!P.count(lastPoint)) {
            P.insert(lastPoint);
            TimeExpandedNode* n2 = getTENode(lastPoint);
            allTENs.push_back(n2);
        }

        if (!S.count(shape)) {
            S.insert(shape);
        }
    }

    for (auto n : allTENs) {
        for (auto s : S) {
            if (s.start == n->origin) {
                n->srcs.push_back(std::make_pair(nullptr, &s));
            } else if (s.end == n->origin) {
                n->tgts.push_back(std::make_pair(nullptr, &s));
            }
        }
    }

    for (auto nA : allTENs) {
        for (auto nB : allTENs) {
            if (nA != nB) {
                std::vector<std::pair<int, int>> nA_to_nB;
                std::vector<std::pair<int, int>> nB_to_nA;
                nB_to_nA = getCoincidences(&(nA->srcs), &(nB->tgts));
                nA_to_nB = getCoincidences(&(nB->srcs), &(nA->tgts));
                nA->srcs.push_back(std::make_pair(nB, nullptr));
                nA->tgts.push_back(std::make_pair(nB, nullptr));
            }
        }
    }

    return allTENs;
}

// Hàm kiểm tra xem có sự trùng khớp giữa các srcs và tgts không
std::vector<std::pair<int, int>> getCoincidences(std::vector<std::pair<TimeExpandedNode*, Shape*>>* srcs,
                                                 std::vector<std::pair<TimeExpandedNode*, Shape*>>* tgts) {
    std::vector<std::pair<int, int>> result;
    for (int i = 0; i < srcs->size(); i++) {
        for (int j = 0; j < tgts->size(); j++) {
            if (srcs->at(i).second == tgts->at(j).second) {
                result.push_back(std::make_pair(i, j));
            }
        }
    }
    return result;
}
//c
void assertShapesAppearance(const std::vector<std::vector<TimeExpandedNode*>>& allTENs) {
    std::unordered_map<Shape*, int> appearanceCount;
    for (const auto& TENs : allTENs) {
        for (const auto& node : TENs) {
            for (const auto& pair : node->srcs) {
                appearanceCount[pair.second]++;
            }
            for (const auto& pair : node->tgts) {
                appearanceCount[pair.second]++;
            }
        }
    }
    for (const auto& pair : appearanceCount) {
        assert(pair.second == 2);
    }
}

void assertPointsAppearance(const std::vector<std::vector<TimeExpandedNode*>>& allTENs) {
    std::unordered_map<Point*, int> appearanceCount;
    for (const auto& TENs : allTENs) {
        for (const auto& node : TENs) {
            appearanceCount[node->origin]++;
        }
    }
    for (const auto& pair : appearanceCount) {
        assert(pair.second == 1);
    }
}

void assertNonNullFields(const std::vector<std::vector<TimeExpandedNode*>>& allTENs) {
    for (const auto& TENs : allTENs) {
        for (const auto& node : TENs) {
            for (const auto& pair : node->srcs) {
                if (!pair.first) {
                    assert(pair.second);
                }
            }
            for (const auto& pair : node->tgts) {
                if (!pair.first) {
                    assert(pair.second);
                }
            }
        }
    }
}

void assertTimeIsZero(const std::vector<std::vector<TimeExpandedNode*>>& allTENs) {
    for (const auto& TENs : allTENs) {
        for (const auto& node : TENs) {
            assert(node->time == 0);
        }
    }
}

void assertTotalAppearance(const std::vector<std::vector<TimeExpandedNode*>>& allTENs) {
    std::unordered_map<TimeExpandedNode*, int> totalAppearance;
    for (const auto& TENs : allTENs) {
        for (const auto& node : TENs) {
            totalAppearance[node] += node->srcs.size() + node->tgts.size();
        }
    }
    for (const auto& TENs : allTENs) {
        for (const auto& node : TENs) {
            for (const auto& pair : node->srcs) {
                assert(totalAppearance[pair.first] == node->srcs.size());
            }
            for (const auto& pair : node->tgts) {
                assert(totalAppearance[pair.first] == node->tgts.size());
            }
        }
    }
}


