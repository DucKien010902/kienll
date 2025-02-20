# TKXDPM.20241.12
## Lời cảm ơn
Nhóm 12 chúng em xin chân thành cảm ơn cô Nguyễn Thị Thu Trang và bạn Mai Anh đã nhiệt tình chỉ dạy và hướng dẫn chúng em trong quá trình thực hiện bài tập lớn môn học.

## Link video demo: (chưa có)

---

## Hướng dẫn chạy dự án:

### BackEnd:
+ Dùng intellij Idea
+ Mở BE lên đợi nó tự build dependences xong
+ Kết nối database trong file application.properties theo các thông tin database trong máy
+ Nhấn run để chạy.
+ Lấy file query.sql đưa vào database vừa tạo rồi chạy file query để thêm data vào.
### FrontEnd: 
+ clone về tải môi trường node ( nếu chưa có )
+ có rồi thì chạy npm install hoặc yarn (tải thư viện)
+ Chạy npm start để khởi động project.

---

## Thành viên nhóm

| Name             | Role        |
|:-----------------| :---------- |
| Phan Phú Huy     | Nhóm trưởng |
| Nguyễn Bình Huy  | Thành viên  |
| Đinh Văn Khang   | Thành viên  |
| Dương Quốc Khánh | Thành viên  |
| Nguyễn Đức Kiên  | Thành viên  |

---

## Danh sách usecase
+ UC001: Tìm kiếm sản phẩm.
+ UC002: Xem sản phẩm.
+ UC003: Thêm sản phẩm vào giỏ hàng.
+ UC004: Quản lý giỏ hàng.
+ UC005: Đặt hàng.
+ UC006: Đặt hàng nhanh.
+ UC007: Thanh toán.
+ UC008: Xem lịch sử mua hàng.
+ UC009: Gửi mail cho khách hàng khi thanh toán thành công.
+ UC010: Hủy đơn hàng.

---

## Danh sách nhiệm vụ.
| Name             | Nhiệm vụ        |
|:-----------------| :---------- |
| Phan Phú Huy     | Phân chia nhiệm vụ của các thành viên nhóm. Viết tài liệu đặc tả, thiết kế. Dựng base front-end, dựng base back-end. Đảm nhiệm phần: thêm sản phẩm vào giỏ, quản lý giỏ hàng|
| Nguyễn Bình Huy  | Viết tài liệu đặc tả, thiết kế. Đảm nhận phần: Danh sách sản phẩm, xem chi tiết sản phẩm, tìm kiếm và lọc sản phẩm(FE) |
| Đinh Văn Khang   | Viết tài liệu đặc tả, thiết kế. Đảm nhận phần: Xử lý thông tin đơn hàng, thanh toán (FE). |
| Dương Quốc Khánh | Viết tài liệu đặc tả, thiết kế. Đảm nhận phần: Xử lý trang kết quả, trang lịch sử và hủy đơn hàng, hủy đơn hàng(backend) |
| Nguyễn Đức Kiên  | Viết tài liệu đặc tả, thiết kế. Đảm nhận phần: Thanh toán VNPay, gửi email cho khách khi thanh toán thành công |

---

## Phân tích Design Concepts và Design Principles 14/12
## 1. Design Concepts: Cohesion và Coupling

### Cohesion (Độ kết dính)

- **Service** và **Repository**:
  - Ví dụ như `OrderService` và `OrderItemRepository` có độ kết dính cao vì `OrderService` tập trung xử lý logic liên quan đến đơn hàng, còn `OrderItemRepository` chỉ phục vụ lưu trữ dữ liệu các mục đơn hàng.
- **Controller**:
  - Mỗi `Controller` như `OrderController`, `CartController` chịu trách nhiệm xử lý request liên quan đến một chức năng cụ thể (ví dụ: giỏ hàng, đơn hàng) → **Cohesion cao**.

### Coupling (Độ phụ thuộc)

- Trong sơ đồ, các **Controller** chỉ tương tác với **Service** (ví dụ: `OrderController` kết nối với `OrderService`). Các **Service** lại kết nối với **Repository**.
- **Low Coupling** được đảm bảo nhờ tách biệt rõ ràng:
  - **Controller** → xử lý HTTP request/response.
  - **Service** → xử lý logic nghiệp vụ.
  - **Repository** → truy cập dữ liệu.
- **Nhận xét**: Các lớp có sự tách biệt vai trò rõ ràng và giảm thiểu phụ thuộc trực tiếp → Đạt **Low Coupling**.

---

## 2. Design Principles: SOLID
Nguyên tắc SOLID là 5 nguyên tắc thiết kế giúp code dễ hiểu, mở rộng và bảo trì.

### S – Single Responsibility Principle (SRP)
- **Mỗi class chỉ có một trách nhiệm duy nhất**.
- **Phân tích**:
  - `OrderController` chỉ xử lý request liên quan đến đơn hàng.
  - `OrderService` chỉ thực hiện logic nghiệp vụ của đơn hàng.
  - `OrderRepository` chỉ tập trung vào thao tác dữ liệu liên quan đến đơn hàng.
- Điều này đảm bảo rằng mỗi class chỉ có **một lý do để thay đổi** → Tuân thủ **SRP**.

### O – Open/Closed Principle (OCP)
- **Mở rộng được nhưng không chỉnh sửa code cũ**.
- **Phân tích**:
  - Nếu muốn thêm một phương thức mới vào `OrderService` hoặc `PaymentService`, bạn chỉ cần mở rộng class mà không thay đổi logic cũ.
  - Ví dụ: Thêm thanh toán mới (VnPayService) không cần chỉnh sửa logic cũ, chỉ thêm vào một service mới.
- Code tuân thủ **OCP** nhờ kiến trúc rõ ràng giữa các Controller, Service và Repository.

### L – Liskov Substitution Principle (LSP)
- **Các class con có thể thay thế class cha mà không làm thay đổi chương trình**.
- **Phân tích**:
  - Giả sử bạn muốn mở rộng hệ thống thanh toán (ví dụ: thêm PayPalService hoặc MomoService), các service mới có thể tuân thủ cùng một interface như `VnPayService`.
  - Điều này cho phép thay thế dễ dàng → **LSP** được tuân thủ.

### I – Interface Segregation Principle (ISP)
- **Không ép buộc class implement các interface không cần thiết**.
- **Phân tích**:
  - Các service như `OrderService`, `InvoiceService` đều chỉ làm những việc cần thiết.
  - Hệ thống của bạn không ép các class phải implement những chức năng không liên quan → Tuân thủ **ISP**.

### D – Dependency Inversion Principle (DIP)
- **Các module cấp cao không phụ thuộc trực tiếp vào module cấp thấp mà phụ thuộc vào abstraction**.
- **Phân tích**:
  - Các controller như `OrderController` không phụ thuộc trực tiếp vào repository mà thông qua **Service** như `OrderService`.
  - Service lại phụ thuộc vào abstraction hoặc interface như `OrderRepository`.
- Điều này đảm bảo hệ thống dễ bảo trì và mở rộng → **DIP** được áp dụng.

---

## 3. Kết luận
Dựa trên các sơ đồ và phân tích:
- **Cohesion** trong hệ thống cao: Các class có trách nhiệm cụ thể và tập trung.
- **Coupling** được giảm thiểu: Sự tách biệt rõ ràng giữa Controller, Service và Repository.
- **SOLID principles** được áp dụng tốt trong hệ thống:
  - **SRP**: Mỗi class có trách nhiệm duy nhất.
  - **OCP**: Dễ dàng mở rộng hệ thống.
  - **LSP**: Thay thế các module dễ dàng.
  - **ISP**: Class chỉ implement các chức năng cần thiết.
  - **DIP**: Module cấp cao phụ thuộc abstraction.

Hệ thống được thiết kế theo kiến trúc **tách lớp (Layered Architecture)** và áp dụng chặt chẽ các nguyên tắc thiết kế **SOLID**, giúp hệ thống linh hoạt, dễ mở rộng và bảo trì.