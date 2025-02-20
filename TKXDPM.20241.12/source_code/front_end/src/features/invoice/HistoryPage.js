import React, { useEffect, useState } from "react";
import { toast, ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import "./HistoryPage.css";
import { OrderService } from "../../services/order.service";
import { formatNumber } from "../../common/utils";
import { PaymentService } from "../../services/payment.service";
import { Radio, FormControlLabel } from "@mui/material";

const HistoryPage = () => {
  const [listOrderHistory, setListOrderHistory] = useState([]);
  const [filterStatus, setFilterStatus] = useState("all"); // Thêm state để quản lý trạng thái lọc
  const [showAllProducts, setShowAllProducts] = useState(false); // Thêm state để quản lý hiển thị sản phẩm
  const [expandedOrderIndex, setExpandedOrderIndex] = useState(null); // Thêm state để quản lý đơn hàng đang mở rộng

  const getListHistoryOrder = async () => {
    try {
      const response = await OrderService.getHistoryOrder();
      setListOrderHistory(response.data.data);
    } catch (err) {
      console.error("Error:", err);
    }
  };

  useEffect(() => {
    getListHistoryOrder();
  }, []);

  const handleCancelOrder = async (id) => {
    try {
      // eslint-disable-next-line no-unused-vars
      const response = await OrderService.cancelOrder(id);
      // eslint-disable-next-line no-unused-vars
      const responseRefund = await PaymentService.refund(id);
      toast.success("Hủy đơn hàng thành công", {
        position: toast.POSITION.TOP_CENTER,
        containerId: "cartToast",
        autoClose: 3000,
        hideProgressBar: true,
        closeOnClick: true,
        closeButton: false,
        theme: "colored",
      });
      getListHistoryOrder();
    } catch (err) {
      console.error("Error:", err);
    }
  };

  const filteredOrders = listOrderHistory.filter((order) => {
    if (filterStatus === "all") return true;
    if (filterStatus === "delivering") return order.status === 1; // Đang giao
    if (filterStatus === "delivered") return order.status === 0; // Đã giao (fake status)
    if (filterStatus === "canceled") return order.status === 2; // Đã hủy
    return false;
  });

  return (
    <>
      <ToastContainer containerId="historyToast" autoClose={3000} />
      <div className="mx-[50px] my-[30px] box-border">
        <div className="flex justify-between items-center mb-[50px]">
          <div className="text-[30px] font-bold">Lịch sử đặt hàng</div>
          <div className="text-[23px] font-medium">
            <span className="text-[#209ed4] font-bold">
              {filteredOrders.length}
            </span>{" "}
            đơn hàng
          </div>
        </div>
        <div className="flex justify-between items-center mb-[20px]">
          <div className="flex items-center">
            <span className="text-lg font-semibold mr-4">Lọc theo:</span>
            <FormControlLabel
              control={
                <Radio
                  value="all"
                  checked={filterStatus === "all"}
                  onChange={() => setFilterStatus("all")}
                  className="text-[#209ed4] hover:text-[#1a7bbf]"
                />
              }
              label="Tất cả"
              className="mr-4"
            />
            <FormControlLabel
              control={
                <Radio
                  value="delivering"
                  checked={filterStatus === "delivering"}
                  onChange={() => setFilterStatus("delivering")}
                  className="text-[#209ed4] hover:text-[#1a7bbf]"
                />
              }
              label="Đang giao"
              className="mr-4"
            />
            <FormControlLabel
              control={
                <Radio
                  value="delivered"
                  checked={filterStatus === "delivered"}
                  onChange={() => setFilterStatus("delivered")}
                  className="text-[#209ed4] hover:text-[#1a7bbf]"
                />
              }
              label="Đã giao"
              className="mr-4"
            />
            <FormControlLabel
              control={
                <Radio
                  value="canceled"
                  checked={filterStatus === "canceled"}
                  onChange={() => setFilterStatus("canceled")}
                  className="text-[#209ed4] hover:text-[#1a7bbf]"
                />
              }
              label="Đã hủy"
              className="mr-4"
            />
          </div>
        </div>
        {
          <div className="w-full">
            <table className="w-full text-left border-collapse">
              <tbody>
                <tr className="bg-[#209ed4]">
                  <th className="text-white py-[13px] text-center font-medium text-[17px]">
                    STT
                  </th>
                  <th className="text-white py-[13px] text-center font-medium text-[17px]">
                    Sản phẩm
                  </th>
                  <th className="text-white py-[13px] text-center font-medium text-[17px]">
                    Thông tin đơn hàng
                  </th>
                  <th className="text-white py-[13px] text-center font-medium text-[17px]"></th>
                </tr>
                {filteredOrders.length > 0 &&
                  filteredOrders.map((order, index) => (
                    <tr key={index} className="border-b border-[#cccccc]">
                      <td className="align-top text-center font-medium py-[20px] bg-[#f5f5f5] text-[17px]">
                        {index + 1}
                      </td>
                      <td className="w-[600px] align-top text-center font-medium py-[20px] bg-[#f5f5f5] text-[17px]">
                        {order.listProduct.length > 0 && (
                          <>
                            {expandedOrderIndex === index ? (
                              order.listProduct.map((item, itemIndex) => (
                                <div
                                  key={itemIndex}
                                  className="flex gap-[20px]"
                                >
                                  <div className="w-[150px]">
                                    <img src={item.mainImg} alt="" />
                                  </div>
                                  <div className="flex flex-col gap-[5px] w-[350px]">
                                    <div className="text-[20px] text-left">
                                      {item.title}
                                    </div>
                                    <div className="flex justify-between w-[250px]">
                                      <div>Số lượng:</div>
                                      <div>{item.quantity}</div>
                                    </div>
                                    <div className="flex justify-between w-[250px]">
                                      <div>Tổng tiền:</div>
                                      <div>
                                        {formatNumber(
                                          item.price * item.quantity
                                        )}{" "}
                                        VND
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              ))
                            ) : (
                              <div className="flex gap-[20px]">
                                <div className="w-[150px]">
                                  <img
                                    src={order.listProduct[0].mainImg}
                                    alt=""
                                  />
                                </div>
                                <div className="flex flex-col gap-[5px] w-[350px]">
                                  <div className="text-[20px] text-left">
                                    {order.listProduct[0].title}
                                  </div>
                                  <div className="flex justify-between w-[250px]">
                                    <div>Số lượng:</div>
                                    <div>{order.listProduct[0].quantity}</div>
                                  </div>
                                  <div className="flex justify-between w-[250px]">
                                    <div>Tổng tiền:</div>
                                    <div>
                                      {formatNumber(
                                        order.listProduct[0].price *
                                          order.listProduct[0].quantity
                                      )}{" "}
                                      VND
                                    </div>
                                  </div>
                                </div>
                              </div>
                            )}
                            {order.listProduct.length > 0 && (
                              <button
                                className="mt-2 text-[#209ed4] hover:underline"
                                onClick={() =>
                                  setExpandedOrderIndex(
                                    expandedOrderIndex === index ? null : index
                                  )
                                }
                              >
                                {expandedOrderIndex === index
                                  ? "Ẩn bớt"
                                  : "Xem chi tiết"}
                              </button>
                            )}
                          </>
                        )}
                      </td>
                      <td className="w-[700px] align-top text-center font-medium py-[20px] bg-[#f5f5f5] text-[17px]">
                        {expandedOrderIndex === index && (
                          <div className="flex flex-col gap-[5px]">
                            <div className="flex">
                              <div className="mr-[30px] font-bold text-black whitespace-nowrap">
                                Tên người nhận:
                              </div>
                              <div className="text-left text-[#333333]">
                                {order.name}
                              </div>
                            </div>
                            <div className="flex">
                              <div className="mr-[30px] font-bold text-black whitespace-nowrap">
                                Số điện thoại:
                              </div>
                              <div className="text-left text-[#333333]">
                                {order.phone}
                              </div>
                            </div>
                            <div className="flex">
                              <div className="mr-[30px] font-bold text-black whitespace-nowrap">
                                Tỉnh/Thành phố:
                              </div>
                              <div className="text-left text-[#333333]">
                                {order.city}
                              </div>
                            </div>
                            <div className="flex">
                              <div className="mr-[30px] font-bold text-black whitespace-nowrap">
                                Địa chỉ giao hàng:
                              </div>
                              <div className="text-left text-[#333333]">
                                {order.address}
                              </div>
                            </div>
                            <div className="flex">
                              <div className="mr-[30px] font-bold text-black whitespace-nowrap">
                                Chỉ dẫn giao hàng:
                              </div>
                              <div className="text-left text-[#333333]">
                                {order.shippingInstruction}
                              </div>
                            </div>
                            <div className="flex">
                              <div className="mr-[30px] font-bold text-black whitespace-nowrap">
                                Giao hàng nhanh:
                              </div>
                              <div className="text-left text-[#333333]">
                                {order.shippingMethod === "Giao hàng tiêu chuẩn"
                                  ? "Không"
                                  : "Có"}
                              </div>
                            </div>
                            <div className="flex">
                              <div className="mr-[30px] font-bold text-black whitespace-nowrap">
                                Thông tin giao hàng nhanh:
                              </div>
                              <div className="text-left text-[#333333]">
                                {order.shipmentDetails}
                              </div>
                            </div>
                            <div className="flex">
                              <div className="mr-[30px] font-bold text-black whitespace-nowrap">
                                Chỉ dẫn giao hàng nhanh:
                              </div>
                              <div className="text-left text-[#333333]">
                                {order.deliveryInstruction}
                              </div>
                            </div>
                            <div className="flex">
                              <div className="mr-[30px] font-bold text-black whitespace-nowrap">
                                Thời gian nhận hàng(GHN):
                              </div>
                              <div className="text-left text-[#333333]">
                                {order.deliveryTime}
                              </div>
                            </div>
                            <div className="flex">
                              <div className="mr-[30px] font-bold text-black whitespace-nowrap">
                                Tổng tiền:
                              </div>
                              <div className="text-left text-[#333333]">
                                {formatNumber(order.originPrice)} VND
                              </div>
                            </div>
                            <div className="flex">
                              <div className="mr-[30px] font-bold text-black whitespace-nowrap">
                                VAT(10%):
                              </div>
                              <div className="text-left text-[#333333]">
                                {formatNumber(order.vat)} VND
                              </div>
                            </div>
                            <div className="flex">
                              <div className="mr-[30px] font-bold text-black whitespace-nowrap">
                                Phí giao hàng:
                              </div>
                              <div className="text-left text-[#333333]">
                                {formatNumber(order.shippingFee)} VND
                              </div>
                            </div>
                            <div className="flex">
                              <div className="mr-[30px] font-bold text-black whitespace-nowrap">
                                Tổng tiền phải trả:
                              </div>
                              <div className="text-left text-[#333333]">
                                {formatNumber(order.totalAmount)} VND
                              </div>
                            </div>
                          </div>
                        )}
                      </td>
                      {order.status === 1 && (
                        <td className="w-[250px] align-top text-center font-medium py-[20px] bg-[#f5f5f5] text-[17px]">
                          <div
                            className="bg-[#db2626] text-white text-center flex justify-center w-[150px] rounded-[8px] py-[8px] cursor-pointer hover:bg-[#9a1313] transition-colors duration-200"
                            onClick={() => handleCancelOrder(order.id)}
                          >
                            Hủy đơn hàng
                          </div>
                        </td>
                      )}
                      {order.status === 2 && (
                        <td className="w-[250px] align-top text-center font-medium py-[20px] bg-[#f5f5f5] text-[17px]">
                          <div className="bg-[#656464] text-white text-center flex justify-center w-[150px] rounded-[8px] py-[8px]">
                            Đã hủy
                          </div>
                        </td>
                      )}
                    </tr>
                  ))}
              </tbody>
            </table>
          </div>
        }
      </div>
    </>
  );
};

export default HistoryPage;
