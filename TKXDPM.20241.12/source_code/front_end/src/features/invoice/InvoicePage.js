import React from "react";
import { useState, useEffect } from "react";
import Typography from "@mui/material/Typography";
import { Box } from "@mui/material";
import Button from "@mui/material/Button";
import { useParams } from "react-router-dom";
import { OrderService } from "../../services/order.service";
import { formatDateTime, formatNumber } from "../../common/utils";
import { CartService } from "../../services/cart.service";
import { PaymentService } from "../../services/payment.service";
import Modal from "@mui/material/Modal";
import VisibilityIcon from "@mui/icons-material/Visibility";
import CloseIcon from "@mui/icons-material/Close";
import "./InvoicePage.css";

const InvoicePage = () => {
  const { orderId } = useParams();
  const [shipping, setShipping] = useState();
  let [res, setRes] = useState({});
  let [medias, setListMedias] = useState([]);
  const [openPreview, setOpenPreview] = useState(false);

  useEffect(() => {
    console.log("id", orderId);
    const getOrderById = async () => {
      const response = await OrderService.getOrderById(orderId);
      console.log("-------", response);
      setRes(response?.data?.data);
      setShipping(response?.data?.data?.order);
    };
    getOrderById();
    getListMediaCart();
  }, []);

  const getListMediaCart = async () => {
    try {
      const response = await CartService.getAllMediaInCart();
      setListMedias(response.data);
    } catch (err) {
      console.error("Error:", err);
    }
  };

  const [urlPayment, setUrlPayment] = useState("");

  const getUrlPayment = async (totalAmount) => {
    try {
      const response = await PaymentService.getPayUrl(totalAmount);
      setUrlPayment(response.data.data);
    } catch (err) {
      console.error("Error:", err);
    }
  };

  const handleConfirmOrder = async () => {
    await getUrlPayment(shipping?.totalAmount);
    if (urlPayment !== "") {
      console.log('***'+urlPayment)
      localStorage.setItem("orderId", orderId);
      window.location.assign(`${urlPayment}`);
    }
  };

  let mediasToShow =
    medias && medias.length > 0
      ? medias.map((media, index) => (
          <div
            key={index}
            className="border-b last:border-b-0 py-6 hover:bg-white/60 transition-all rounded-lg"
          >
            <div className="flex items-center space-x-6">
              {/* Hình ảnh sản phẩm */}
              <div className="flex-shrink-0">
                <img
                  src={media.imageUrl}
                  alt={media.title}
                  className="w-28 h-36 object-cover rounded-lg shadow-md hover:shadow-lg transition-all"
                />
              </div>

              {/* Thông tin sản phẩm */}
              <div className="flex-grow">
                <h3 className="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">
                  {media.title}
                </h3>
                <div className="space-y-2">
                  <p className="text-sm text-gray-500">
                    Mã sản phẩm: #{media.id}
                  </p>
                  <div className="flex items-center text-gray-600">
                    <span>Số lượng: </span>
                    <span className="font-semibold text-gray-800 ml-2">
                      {media.quantity}
                    </span>
                  </div>
                </div>
              </div>

              {/* Giá */}
              <div className="flex-shrink-0 text-right">
                <div className="mb-3">
                  <p className="text-sm text-gray-500 mb-1">Đơn giá:</p>
                  <p className="text-lg font-semibold text-[#1a3a6d]">
                    {formatNumber(media.price)} VND
                  </p>
                </div>
                <div>
                  <p className="text-sm text-gray-500 mb-1">Thành tiền:</p>
                  <p className="text-lg font-bold text-[#209ed4]">
                    {formatNumber(media.price * media.quantity)} VND
                  </p>
                </div>
              </div>
            </div>
          </div>
        ))
      : null;

  const modalStyle = {
    position: "absolute",
    top: "10%",
    left: "50%",
    transform: "translate(-50%, 0)",
    width: "90%",
    maxWidth: "750px",
    bgcolor: "background.paper",
    boxShadow: 24,
    p: 4,
    overflow: "auto",
    bottom: "10%",
  };

  return (
    <div className="bg-gray-100 min-h-screen py-6">
      <div className="container mx-auto px-4 max-w-6xl">
        {/* Header */}
        <div className="mb-6">
          <h1 className="text-2xl font-bold text-[#1a3a6d] text-center">
            Chi tiết đơn hàng
          </h1>
        </div>

        {/* Main Content */}
        <div className="bg-white rounded-xl shadow-lg p-6">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-6">
            {/* Shipping Info */}
            <div className="lg:col-span-4">
              <div className="bg-gray-50 rounded-lg p-5">
                <h2 className="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">
                  Thông tin giao hàng
                </h2>
                <div className="space-y-3">
                  {res?.orderShipping?.name && (
                    <div className="flex flex-col">
                      <span className="text-sm text-gray-500">Người nhận:</span>
                      <span className="font-medium text-gray-800">
                        {res?.orderShipping?.name}
                      </span>
                    </div>
                  )}
                  {res?.orderShipping?.phone && (
                    <div className="flex flex-col">
                      <span className="text-sm text-gray-500">
                        Số điện thoại:
                      </span>
                      <span className="font-medium text-gray-800">
                        {res?.orderShipping?.phone}
                      </span>
                    </div>
                  )}
                  {res?.orderShipping?.address && (
                    <div className="flex flex-col">
                      <span className="text-sm text-gray-500">Địa chỉ:</span>
                      <span className="font-medium text-gray-800">
                        {res?.orderShipping?.address}
                      </span>
                    </div>
                  )}
                  {res?.orderShipping?.city && (
                    <div className="flex flex-col">
                      <span className="text-sm text-gray-500">Thành phố:</span>
                      <span className="font-medium text-gray-800">
                        {res?.orderShipping?.city}
                      </span>
                    </div>
                  )}
                </div>
              </div>

              {/* Payment Summary */}
              <div className="bg-gray-50 rounded-lg p-5 mt-6">
                <h2 className="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">
                  Tổng thanh toán
                </h2>
                <div className="space-y-3">
                  <div className="flex justify-between">
                    <span className="text-gray-500">Tạm tính:</span>
                    <span className="font-medium">
                      {formatNumber(shipping?.originPrice)} VND
                    </span>
                  </div>
                  <div className="flex justify-between">
                    <span className="text-gray-500">VAT (10%):</span>
                    <span className="font-medium">
                      {formatNumber((shipping?.originPrice * 10) / 100)} VND
                    </span>
                  </div>
                  <div className="flex justify-between">
                    <span className="text-gray-500">Phí vận chuyển:</span>
                    <span className="font-medium">
                      {formatNumber(shipping?.shippingFee)} VND
                    </span>
                  </div>
                  <div className="pt-3 mt-3 border-t">
                    <div className="flex justify-between">
                      <span className="font-semibold text-gray-800">
                        Tổng cộng:
                      </span>
                      <span className="font-bold text-lg text-[#209ed4]">
                        {formatNumber(shipping?.totalAmount)} VND
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {/* Product List */}
            <div className="lg:col-span-8">
              <div className="bg-gray-50 rounded-lg p-5">
                <div className="flex items-center justify-between mb-4 pb-2 border-b">
                  <h2 className="text-lg font-semibold text-gray-800">
                    Danh sách sản phẩm
                  </h2>
                  <Button
                    startIcon={<VisibilityIcon />}
                    onClick={() => setOpenPreview(true)}
                    className="bg-[#209ed4] text-white text-sm hover:bg-[#1b8dbf] transition-all"
                    variant="contained"
                    size="small"
                  >
                    Xem hóa đơn
                  </Button>
                </div>

                <div className="max-h-[calc(100vh-400px)] overflow-auto pr-2 custom-scrollbar">
                  <div className="space-y-4">
                    {medias.map((media, index) => (
                      <div
                        key={index}
                        className="bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-all"
                      >
                        <div className="flex gap-4">
                          <div className="flex-shrink-0">
                            <img
                              src={media.imageUrl}
                              alt={media.title}
                              className="w-20 h-28 object-cover rounded-md"
                            />
                          </div>
                          <div className="flex-grow min-w-0">
                            <h3 className="font-medium text-gray-800 mb-1 truncate">
                              {media.title}
                            </h3>
                            <p className="text-sm text-gray-500 mb-2">
                              Mã SP: #{media.id}
                            </p>
                            <div className="flex items-center text-sm text-gray-600">
                              <span>Số lượng: {media.quantity}</span>
                            </div>
                          </div>
                          <div className="flex-shrink-0 text-right">
                            <p className="text-sm text-gray-500">Đơn giá</p>
                            <p className="font-medium text-gray-800">
                              {formatNumber(media.price)} VND
                            </p>
                            <p className="text-sm text-gray-500 mt-2">
                              Thành tiền
                            </p>
                            <p className="font-bold text-[#209ed4]">
                              {formatNumber(media.price * media.quantity)} VND
                            </p>
                          </div>
                        </div>
                      </div>
                    ))}
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Payment Button */}
          <div className="mt-6 text-center">
            <Button
              variant="contained"
              className="bg-green-600 hover:bg-green-700 transition-all text-white px-8 py-2"
              onClick={handleConfirmOrder}
            >
              Xác nhận thanh toán
            </Button>
          </div>
        </div>
      </div>

      {/* Invoice Preview Modal */}
      <Modal
        open={openPreview}
        onClose={() => setOpenPreview(false)}
        aria-labelledby="invoice-preview"
      >
        <Box
          sx={{
            ...modalStyle,
            maxHeight: "80vh",
            overflow: "auto",
          }}
          className="bg-white rounded-lg"
          id="printable-invoice"
        >
          {/* Nút Đóng */}
          <div className="flex justify-end">
            <Button
              variant="outlined"
              onClick={() => setOpenPreview(false)}
              className="mb-4 border-gray-300 text-gray-700 hover:bg-gray-100 transition-all"
              startIcon={<CloseIcon />}
            >
              Đóng
            </Button>
          </div>

          {/* Logo và thông tin công ty */}
          <div className="text-center mb-8">
            <Typography variant="h4" className="font-bold text-[#1a3a6d] mb-2">
              MEDIA COMPANY
            </Typography>
            <Typography className="text-gray-600">
              123 Đường ABC, Quận XYZ, TP.Hà Nội
            </Typography>
            <Typography className="text-gray-600">
              Điện thoại: (028) 1234 5678 - Email: contact@media.com
            </Typography>
          </div>

          {/* Tiêu đề hóa đơn */}
          <div className="text-center mb-8">
            <Typography variant="h5" className="font-bold text-gray-800">
              HÓA ĐƠN BÁN HÀNG
            </Typography>
            <Typography className="text-gray-600 mt-2">
              Số: {orderId}
            </Typography>
            <Typography className="text-gray-600">
              Ngày: {formatDateTime(new Date())}
            </Typography>
          </div>

          {/* Thông tin khách hàng */}
          <div className="mb-8 p-4 bg-gray-50 rounded-lg">
            <Typography
              variant="h6"
              className="font-semibold mb-4 text-gray-800"
            >
              THÔNG TIN KHÁCH HÀNG
            </Typography>
            <div className="grid grid-cols-2 gap-y-2">
              <div className="text-gray-600">Họ và tên:</div>
              <div className="font-medium">{res?.orderShipping?.name}</div>
              <div className="text-gray-600">Số điện thoại:</div>
              <div className="font-medium">{res?.orderShipping?.phone}</div>
              <div className="text-gray-600">Địa chỉ:</div>
              <div className="font-medium">{res?.orderShipping?.address}</div>
              <div className="text-gray-600">Thành phố:</div>
              <div className="font-medium">{res?.orderShipping?.city}</div>
            </div>
          </div>

          {/* Chi tiết đơn hàng */}
          <div className="mb-8">
            <Typography
              variant="h6"
              className="font-semibold mb-4 text-gray-800"
            >
              CHI TIẾT ĐƠN HÀNG
            </Typography>
            <table className="w-full">
              <thead>
                <tr className="bg-gray-100">
                  <th className="py-3 px-4 text-left font-semibold text-gray-700 border-b">
                    STT
                  </th>
                  <th className="py-3 px-4 text-left font-semibold text-gray-700 border-b">
                    Tên sản phẩm
                  </th>
                  <th className="py-3 px-4 text-center font-semibold text-gray-700 border-b">
                    Số lượng
                  </th>
                  <th className="py-3 px-4 text-right font-semibold text-gray-700 border-b">
                    Đơn giá
                  </th>
                  <th className="py-3 px-4 text-right font-semibold text-gray-700 border-b">
                    Thành tiền
                  </th>
                </tr>
              </thead>
              <tbody>
                {medias.map((media, index) => (
                  <tr key={index} className="border-b">
                    <td className="py-3 px-4 text-gray-600">{index + 1}</td>
                    <td className="py-3 px-4 text-gray-800 font-medium">
                      {media.title}
                    </td>
                    <td className="py-3 px-4 text-center text-gray-600">
                      {media.quantity}
                    </td>
                    <td className="py-3 px-4 text-right text-gray-600">
                      {formatNumber(media.price)} VND
                    </td>
                    <td className="py-3 px-4 text-right font-medium text-gray-800">
                      {formatNumber(media.price * media.quantity)} VND
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>

          {/* Tổng tiền */}
          <div className="flex justify-end mb-8">
            <div className="w-80 bg-gray-50 p-4 rounded-lg">
              <div className="space-y-3">
                <div className="flex justify-between text-gray-600">
                  <span>Tạm tính:</span>
                  <span>{formatNumber(shipping?.originPrice)} VND</span>
                </div>
                <div className="flex justify-between text-gray-600">
                  <span>VAT (10%):</span>
                  <span>
                    {formatNumber((shipping?.originPrice * 10) / 100)} VND
                  </span>
                </div>
                <div className="flex justify-between text-gray-600">
                  <span>Phí vận chuyển:</span>
                  <span>{formatNumber(shipping?.shippingFee)} VND</span>
                </div>
                <div className="pt-2 border-t">
                  <div className="flex justify-between font-bold text-lg text-gray-800">
                    <span>Tổng cộng:</span>
                    <span>{formatNumber(shipping?.totalAmount)} VND</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Chữ ký */}
          <div className="grid grid-cols-2 gap-8 text-center mt-12">
            <div>
              <Typography className="font-semibold text-gray-800 mb-12">
                Người mua hàng
              </Typography>
              <Typography className="text-gray-500 italic">
                (Ký, ghi rõ họ tên)
              </Typography>
            </div>
            <div>
              <Typography className="font-semibold text-gray-800 mb-12">
                Người bán hàng
              </Typography>
              <Typography className="text-gray-500 italic">
                (Ký, ghi rõ họ tên)
              </Typography>
            </div>
          </div>

          {/* Footer */}
          <div className="text-center mt-12 text-gray-500">
            <Typography className="font-medium mb-1">
              Cảm ơn quý khách đã mua hàng!
            </Typography>
            <Typography className="text-sm">
              Mọi thắc mắc xin vui lòng liên hệ: Hotline 1900 xxxx
            </Typography>
          </div>
        </Box>
      </Modal>
    </div>
  );
};

export default InvoicePage;
