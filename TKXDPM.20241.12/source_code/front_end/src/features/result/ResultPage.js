import HeaderBar from "../../components/layout/HeaderBar";
import "./ResultPage.css";
import SuccessIcon from "../../assets/images/successIcon.png";
import { useLocation, useNavigate } from "react-router-dom";
import { convertDateTimeFormat, formatNumber } from "../../common/utils";
import { CartService } from "../../services/cart.service";
import { useEffect } from "react";
import { useNumProduct } from "../carts/NumProductInCartContext";
import { OrderService } from "../../services/order.service";
import { PaymentService } from "../../services/payment.service";

const ResultPage = () => {
  const location = useLocation();
  const queryParams = new URLSearchParams(location.search);
  const orderId = localStorage.getItem("orderId");
  console.log("Order ID:", orderId);

  const vnp_ResponseCode = queryParams.get("vnp_ResponseCode"); // Kiểm tra mã phản hồi từ VNPay
  const vnp_TransactionNo = queryParams.get("vnp_TransactionNo");
  const vnp_Amount = queryParams.get("vnp_Amount");
  const vnp_OrderInfo = queryParams.get("vnp_OrderInfo");
  const vnp_PayDate = queryParams.get("vnp_PayDate");
  const vnp_TxnRef = queryParams.get("vnp_TxnRef");

  const { updateNumProduct } = useNumProduct();
  const navigate = useNavigate();

  const deleteCart = async () => {
    try {
      await CartService.deleteCart();
      console.log("Cart deleted successfully.");
    } catch (err) {
      console.error("Error deleting cart:", err);
    }
  };

  const paymentSuccess = async () => {
    try {
      await OrderService.orderSuccess(orderId);
      console.log("Order marked as successful.");
    } catch (err) {
      console.error("Error marking order as successful:", err);
    }
  };

  const makePayment = async () => {
    try {
      const paymentInfo = {
        order_id: orderId,
        vnp_TransactionStatus: vnp_ResponseCode,
        vnp_TransactionNo: vnp_TransactionNo,
        vnp_OrderInfo: vnp_OrderInfo,
        vnp_Amount: vnp_Amount,
        vnp_PayDate: vnp_PayDate,
        vnp_TxnRef: vnp_TxnRef,
      };
      console.log(paymentInfo)
      await PaymentService.makePayment(paymentInfo);
      console.log("Payment information recorded.");
    } catch (err) {
      console.error("Error recording payment information:", err);
    }
  };

  useEffect(() => {
    if (vnp_ResponseCode !== "00") {
      navigate("/delivery");
      return;
    }

    // Nếu giao dịch thành công
    deleteCart();
    updateNumProduct(0);
    makePayment();
    paymentSuccess();
  }, [vnp_ResponseCode, orderId, navigate]);

  if (vnp_ResponseCode !== "00") {
    return null; 
  }

  return (
    <div className="result-page">
      <div className="name-page">Kết quả thanh toán đơn hàng</div>
      <div className="result-payment-box">
        <div>
          <img src={SuccessIcon} alt="Success" />
        </div>
        <div className="result-text">Bạn đã thanh toán thành công</div>
        <div className="payment-info">
          <div className="info-item">
            <div>Mã giao dịch:</div>
            <div>{vnp_TransactionNo}</div>
          </div>
          <div className="info-item">
            <div>Số tiền giao dịch:</div>
            <div>{formatNumber(parseInt(vnp_Amount) / 100)} VND</div>
          </div>
          <div className="info-item">
            <div>Nội dung giao dịch:</div>
            <div>{vnp_OrderInfo}</div>
          </div>
          <div className="info-item">
            <div>Thời gian giao dịch:</div>
            <div>{convertDateTimeFormat(vnp_PayDate)}</div>
          </div>
        </div>
      </div>
      <div className="homepage-btn" onClick={() => navigate("/")}>
        Về trang chủ
      </div>
    </div>
  );
};

export default ResultPage;
//kiên