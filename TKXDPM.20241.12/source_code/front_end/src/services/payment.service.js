import axios from "axios";

axios.defaults.baseURL = "http://localhost:9696/tkxdpm/api/v1";
export const PaymentService = {
    getPayUrl: async (totalPrice) => {
        const response = await axios.get("/payments/get-pay-url", {
            params: { totalPrice },
        });
        return response;
    },
    makePayment: async (paymentInfo) => {
        const response = await axios.post("/payments", paymentInfo);
        return response;
    },
    refund: async (orderId) => {
        const response = await axios.post(`/payments/refund/${orderId}`);
        return response;
    }
};
