package com.tkxdpm_be.controllers;

import com.tkxdpm_be.services.EmailService;
import com.tkxdpm_be.services.OrderService;
import com.tkxdpm_be.services.VnPayService;
import model.BaseResponse;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;
import utils.ApiException;

import java.io.IOException;
import java.text.ParseException;
import java.util.Hashtable;
import java.util.Map;
import java.time.format.DateTimeFormatter;
import java.time.LocalDateTime;
import static org.apache.catalina.manager.JspHelper.formatNumber;


@RestController
@CrossOrigin(allowedHeaders = "*", origins = "*")
@RequestMapping("/payments")
public class PaymentController {
    @Autowired
    VnPayService vnPayService;

    @Autowired
    private EmailService emailService;
    @Autowired
    private OrderService orderService;


    @GetMapping("/get-pay-url")
    public BaseResponse<String> generatePayUrl(@RequestParam Integer totalPrice) {
        BaseResponse<String> response = new BaseResponse<>();
        response.setData(this.vnPayService.generatePayUrl(totalPrice));
        return response;
    }

    @PostMapping("/refund/{order-id}")
    public BaseResponse<String> refundPayment(@PathVariable(name = "order-id") Long orderId) throws IOException, ParseException, ApiException {
        BaseResponse<String> response = new BaseResponse<>();
        response.setData(this.vnPayService.refund(orderId));
        return response;
    }

    @PostMapping
    public BaseResponse<Map<String, String>> makePayment(@RequestBody Map<String, String> res) {
        System.out.println(res);
        BaseResponse<Map<String, String>> response = new BaseResponse<>();
        Map<String, String> result = new Hashtable<String, String>();
        try {
            vnPayService.makePaymentTransaction(res);
            result.put("RESULT", "PAYMENT SUCCESSFUL!");
            result.put("MESSAGE", "You have successfully paid the order!");

            String transactionNo = res.get("vnp_TransactionNo");
            String amount = res.get("vnp_Amount");
            String payDateString = res.get("vnp_PayDate");

            LocalDateTime date = LocalDateTime.parse(payDateString, DateTimeFormatter.ofPattern("yyyyMMddHHmmss"));
            String formattedDate = date.format(DateTimeFormatter.ofPattern("dd-MM-yyyy HH:mm:ss"));
            String formattedAmount = formatNumber(Long.parseLong(amount) / 100) + " VND";

            // Tạo nội dung email
            String emailContent = String.format(
                    "Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi!\n" +
                            "Mã giao dịch: %s\n" +
                            "Số tiền giao dịch: %s\n" +
                            "Thời gian giao dịch: %s",
                    transactionNo, formattedAmount, formattedDate);
            System.out.println(emailContent);
            //lấy email người dùng
            String customerEmail = orderService.getCustomerEmail();

            if (customerEmail != null && !customerEmail.isEmpty()) {
                System.out.println("Đang gửi email đến: " + customerEmail);
                emailService.sendEmail(customerEmail, "Xác nhận đơn hàng", emailContent);
                System.out.println("Email đã được gửi thành công đến: " + customerEmail);
            } else {
                System.out.println("Email không hợp lệ, không gửi email.");
            }

        } catch (ApiException e) {
            result.put("MESSAGE", e.getMessage());
            result.put("RESULT", "PAYMENT FAILED!");
        }

        return response;
    }
}
