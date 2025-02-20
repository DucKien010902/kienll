import React, { useEffect } from "react";

import { useForm } from "react-hook-form";
import { useState } from "react";
import { formatNumber } from "../../common/utils";
import { OrderService } from "../../services/order.service";
import ToastUtil from "../../common/utils";
import { useNavigate } from "react-router-dom";
import { CartService } from "../../services/cart.service";
import { ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

export default function DeliveryPage() {
  const [listMedia, setListMedia] = useState([]);
  const [subtotal, setSubtotal] = useState(0);
  const [isExpressDelivery, setIsExpressDelivery] = useState(false);
  const [shippingFee, setShippingFee] = useState(0);
  const [minTime, setMinTime] = useState("");
  const [city, setCity] = useState("An Giang");

  const [selectedShippingMethod, setSelectedShippingMethod] = useState(
    "Giao hàng tiêu chuẩn"
  );
  const navigate = useNavigate();
  const {
    register,
    handleSubmit,
    getValues,
    formState: { errors },
  } = useForm();

  const getListMediaCart = async () => {
    try {
      const response = await CartService.getAllMediaInCart();
      setListMedia(response.data);
    } catch (err) {
      console.error("Error:", err);
    }
  };

  const getTotalPriceInCart = async () => {
    try {
      const response = await CartService.getTotalPriceInCart();
      setSubtotal(Math.round(response.data));
    } catch (err) {
      console.error("Error:", err);
    }
  };

  const getShippingFee = async () => {
    try {
      const res = {
        orderShipping: {
          city: city,
        },
        medias: listMedia,
        userId: "1",
      };
      const isRush =
        selectedShippingMethod === "Giao hàng tiêu chuẩn" ? false : true;
      const response = await OrderService.calculateShippingFee(res, isRush);
      setShippingFee(response.data.data);
    } catch (error) {
      console.error("Error calculating shipping fee:", error);
    }
  };

  useEffect(() => {
    getListMediaCart();
    getTotalPriceInCart();
  }, []);

  useEffect(() => {
    if (listMedia.length > 0) {
      getShippingFee();
    }
  }, [listMedia, selectedShippingMethod]);

  const onSubmit = async (data) => {
    console.log(data);

    try {
      const request = {
        orderShipping: {
          name: data?.name ?? "",
          phone: data?.phone ?? "",
          email: data?.email ?? "",
          city: data?.city ?? "",
          address: data?.address ?? "",
          shippingInstruction: data?.shippingInstruction ?? "",
          shippingMethod: selectedShippingMethod,
          shipmentDetails: data?.shipmentDetails ?? "",
          deliveryInstruction: data?.deliveryInstruction ?? "",
          deliveryTime: data?.deliveryTime ?? "",
        },
        medias: listMedia.map((media) => ({ ...media, id: media?.mediaId })),
        shippingFee: shippingFee,
        userId: "1",
      };
      const response = await OrderService.createOrder(request);
      console.log("---------", response);
      if (response?.data?.message === "Success") {
        navigate(`/invoice/${response?.data?.data}`);
      }
    } catch (error) {
      console.error("Error create order:", error);
    }
  };

  const handleCityChange = async (selectedCity) => {
    try {
      const res = {
        orderShipping: {
          city: selectedCity,
        },
        medias: listMedia,
        userId: "1",
      };
      setCity(selectedCity);
      if (
        selectedShippingMethod === "Giao hàng nhanh" &&
        selectedCity !== "Hà Nội"
      ) {
        setIsExpressDelivery(false);
        setSelectedShippingMethod("Giao hàng tiêu chuẩn");
      }
      const isRush =
        selectedShippingMethod === "Giao hàng tiêu chuẩn" ? false : true;
      const response = await OrderService.calculateShippingFee(res, isRush);
      setShippingFee(response.data.data);
    } catch (error) {
      console.error("Error calculating shipping fee:", error);
    }
  };

  const checkExpressMethod = () => {
    console.log("-------", listMedia);
    if (listMedia?.filter((media) => media.isRush).length === 0) {
      ToastUtil.showToastError(
        "Sản phẩm trong giỏ hàng không hỗ trợ giao hàng nhanh"
      );
      setIsExpressDelivery(false);
      setSelectedShippingMethod("Giao hàng tiêu chuẩn");
      return;
    } else if (city !== "Hà Nội") {
      ToastUtil.showToastError(
        "Không hỗ trợ giao hàng nhanh ở tỉnh/thành phố bạn chọn"
      );
      setIsExpressDelivery(false);
      setSelectedShippingMethod("Giao hàng tiêu chuẩn");
      return;
    }
    setIsExpressDelivery(true);
    setSelectedShippingMethod("Giao hàng nhanh");
  };

  useEffect(() => {
    const now = new Date();
    const year = now.getFullYear();
    const month = (now.getMonth() + 1).toString().padStart(2, "0");
    const day = now.getDate().toString().padStart(2, "0");
    const hours = now.getHours().toString().padStart(2, "0");
    const minutes = now.getMinutes().toString().padStart(2, "0");

    const minTime = `${year}-${month}-${day}T${hours}:${minutes}`;
    setMinTime(minTime);
  }, []);

  const inputClassName =
    "w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-700 text-base transition duration-200 ease-in-out focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 disabled:bg-gray-100";
  const labelClassName =
    "block w-[180px] shrink-0 text-sm font-medium text-gray-700";
  const formGroupClassName = "flex flex-col space-y-1";
  const inputGroupClassName = "flex items-start gap-4";
  const errorClassName = "text-sm text-red-500 ml-[180px] mt-1";

  return (
    <>
      <ToastContainer
        position="top-right"
        autoClose={3000}
        hideProgressBar={false}
        newestOnTop={false}
        closeOnClick
        rtl={false}
        pauseOnFocusLoss
        draggable
        pauseOnHover
        theme="light"
        className="mt-16"
      />

      <div className="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 px-4 py-8 sm:px-6 lg:px-8">
        <div className="mx-auto max-w-7xl">
          <div className="grid grid-cols-1 gap-8 lg:grid-cols-12">
            <div className="lg:col-span-8">
              <form
                onSubmit={handleSubmit(onSubmit)}
                className="rounded-xl bg-white p-8 shadow-xl transition-all duration-300 hover:shadow-2xl"
              >
                <h2 className="mb-8 text-center text-2xl font-bold text-gray-800 border-b pb-4">
                  Thông tin giao hàng
                </h2>

                <div className="space-y-6">
                  <div className={formGroupClassName}>
                    <div className={inputGroupClassName}>
                      <label className={labelClassName} htmlFor="name">
                        Họ và tên <span className="text-red-500">*</span>
                      </label>
                      <div className="flex-1">
                        <input
                          type="text"
                          id="name"
                          className={inputClassName}
                          placeholder="Nhập họ và tên"
                          {...register("name", {
                            required: "Họ và tên là trường bắt buộc",
                            minLength: {
                              value: 2,
                              message: "Họ và tên phải có ít nhất 2 ký tự!",
                            },
                            pattern: {
                              value: /^[a-zA-ZÀ-ỹ\s]+$/,
                              message: "Họ và tên chỉ được chứa chữ cái!",
                            },
                          })}
                        />
                        {errors?.name?.message && (
                          <p className={errorClassName}>
                            {errors.name.message}
                          </p>
                        )}
                      </div>
                    </div>
                  </div>

                  <div className={formGroupClassName}>
                    <div className={inputGroupClassName}>
                      <label className={labelClassName} htmlFor="phone">
                        Số điện thoại <span className="text-red-500">*</span>
                      </label>
                      <div className="flex-1">
                        <input
                          type="tel"
                          id="phone"
                          className={inputClassName}
                          placeholder="Nhập số điện thoại"
                          {...register("phone", {
                            required: "Số điện thoại là trường bắt buộc!",
                            pattern: {
                              value: /(84|0[3|5|7|8|9])+([0-9]{8})\b/,
                              message: "Số điện thoại không hợp lệ",
                            },
                          })}
                        />
                        {errors?.phone?.message && (
                          <p className={errorClassName}>
                            {errors.phone.message}
                          </p>
                        )}
                      </div>
                    </div>
                  </div>
                  <div className={formGroupClassName}>
                    <div className={inputGroupClassName}>
                      <label className={labelClassName} htmlFor="email">
                        Email <span className="text-red-500">*</span>
                      </label>
                      <div className="flex-1">
                        <input
                          type="email"
                          id="email"
                          className={inputClassName}
                          placeholder="Nhập email"
                          {...register("email", {
                            required: "Email là trường bắt buộc!",
                            pattern: {
                              value: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
                              message: "Email không hợp lệ!",
                            },
                          })}
                        />
                        {errors?.email?.message && (
                          <p className={errorClassName}>
                            {errors.email.message}
                          </p>
                        )}
                      </div>
                    </div>
                  </div>

                  <div className={formGroupClassName}>
                    <div className={inputGroupClassName}>
                      <label className={labelClassName} htmlFor="city">
                        Tỉnh/Thành phố <span className="text-red-500">*</span>
                      </label>
                      <select
                        id="city"
                        className={inputClassName}
                        {...register("city", { required: true })}
                        onChange={(e) => handleCityChange(e.target.value)}
                      >
                        <option value="An Giang">An Giang</option>
                        <option value="Bà Rịa - Vũng Tàu">
                          Bà Rịa - Vũng Tàu
                        </option>
                        <option value="Bắc Giang">Bắc Giang</option>
                        <option value="Bắc Kạn">Bắc Kạn</option>
                        <option value="Bắc Ninh">Bắc Ninh</option>
                        <option value="Bến Tre">Bến Tre</option>
                        <option value="Bình Định">Bình Định</option>
                        <option value="Bình Dương">Bình Dương</option>
                        <option value="Bình Phước">Bình Phước</option>
                        <option value="Bình Thuận">Bình Thuận</option>
                        <option value="Cà Mau">Cà Mau</option>
                        <option value="Cần Thơ">Cần Thơ</option>
                        <option value="Cao Bằng">Cao Bằng</option>
                        <option value="Đà Nẵng">Đà Nẵng</option>
                        <option value="Đắk Lắk">Đắk Lắk</option>
                        <option value="Đắk Nông">Đắk Nông</option>
                        <option value="Điện Biên">Điện Biên</option>
                        <option value="Đồng Nai">Đồng Nai</option>
                        <option value="Đồng Tháp">Đồng Tháp</option>
                        <option value="Gia Lai">Gia Lai</option>
                        <option value="Hà Giang">Hà Giang</option>
                        <option value="Hà Nam">Hà Nam</option>
                        <option value="Hà Nội">Hà Nội</option>
                        <option value="Hà Tĩnh">Hà Tĩnh</option>
                        <option value="Hải Dương">Hải Dương</option>
                        <option value="Hải Phòng">Hải Phòng</option>
                        <option value="Hậu Giang">Hậu Giang</option>
                        <option value="Hòa Bình">Hòa Bình</option>
                        <option value="Hưng Yên">Hưng Yên</option>
                        <option value="Khánh Hòa">Khánh Hòa</option>
                        <option value="Kiên Giang">Kiên Giang</option>
                        <option value="Kon Tum">Kon Tum</option>
                        <option value="Lai Châu">Lai Châu</option>
                        <option value="Lâm Đồng">Lâm Đồng</option>
                        <option value="Lạng Sơn">Lạng Sơn</option>
                        <option value="Lào Cai">Lào Cai</option>
                        <option value="Long An">Long An</option>
                        <option value="Nam Định">Nam Định</option>
                        <option value="Nghệ An">Nghệ An</option>
                        <option value="Ninh Bình">Ninh Bình</option>
                        <option value="Ninh Thuận">Ninh Thuận</option>
                        <option value="Phú Thọ">Phú Thọ</option>
                        <option value="Phú Yên">Phú Yên</option>
                        <option value="Quảng Bình">Quảng Bình</option>
                        <option value="Quảng Nam">Quảng Nam</option>
                        <option value="Quảng Ngãi">Quảng Ngãi</option>
                        <option value="Quảng Ninh">Quảng Ninh</option>
                        <option value="Quảng Trị">Quảng Trị</option>
                        <option value="Sóc Trăng">Sóc Trăng</option>
                        <option value="Sơn La">Sơn La</option>
                        <option value="Tây Ninh">Tây Ninh</option>
                        <option value="Thái Bình">Thái Bình</option>
                        <option value="Thái Nguyên">Thái Nguyên</option>
                        <option value="Thanh Hóa">Thanh Hóa</option>
                        <option value="Thừa Thiên-Huế">Thừa Thiên-Huế</option>
                        <option value="Tiền Giang">Tiền Giang</option>
                        <option value="Trà Vinh">Trà Vinh</option>
                        <option value="Tuyên Quang">Tuyên Quang</option>
                        <option value="Vĩnh Long">Vĩnh Long</option>
                        <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                        <option value="Yên Bái">Yên Bái</option>
                      </select>
                    </div>
                  </div>

                  <div className={formGroupClassName}>
                    <div className={inputGroupClassName}>
                      <label className={labelClassName} htmlFor="address">
                        Địa chỉ <span className="text-red-500">*</span>
                      </label>
                      <div className="flex-1">
                        <textarea
                          className={`${inputClassName} min-h-[100px] resize-y`}
                          placeholder="Nhập địa chỉ chi tiết"
                          {...register("address", {
                            required: "Địa chỉ là trường bắt buộc",
                          })}
                        />
                        {errors?.address?.message && (
                          <p className={errorClassName}>
                            {errors.address.message}
                          </p>
                        )}
                      </div>
                    </div>
                  </div>

                  <div className={formGroupClassName}>
                    <div className={inputGroupClassName}>
                      <label className={labelClassName}>
                        Phương thức giao hàng{" "}
                        <span className="text-red-500">*</span>
                      </label>
                      <div className="flex gap-8">
                        <label className="flex items-center gap-2 cursor-pointer">
                          <input
                            type="radio"
                            name="shippingMethod"
                            className="h-4 w-4 text-blue-600 focus:ring-blue-500"
                            value="Giao hàng tiêu chuẩn"
                            onClick={() => {
                              setIsExpressDelivery(false);
                              setSelectedShippingMethod("Giao hàng tiêu chuẩn");
                            }}
                            checked={
                              selectedShippingMethod === "Giao hàng tiêu chuẩn"
                            }
                          />
                          <span className="text-gray-700">
                            Giao hàng tiêu chuẩn
                          </span>
                        </label>
                        <label className="flex items-center gap-2 cursor-pointer">
                          <input
                            type="radio"
                            name="shippingMethod"
                            className="h-4 w-4 text-blue-600 focus:ring-blue-500"
                            value="Giao hàng nhanh"
                            onClick={checkExpressMethod}
                            checked={
                              selectedShippingMethod === "Giao hàng nhanh"
                            }
                          />
                          <span className="text-gray-700">Giao hàng nhanh</span>
                        </label>
                      </div>
                    </div>
                  </div>

                  {isExpressDelivery && (
                    <>
                      <div className={formGroupClassName}>
                        <div className={inputGroupClassName}>
                          <label
                            className={labelClassName}
                            htmlFor="deliveryTime"
                          >
                            Thời gian nhận hàng{" "}
                            <span className="text-red-500">*</span>
                          </label>
                          <div className="flex-1">
                            <input
                              type="datetime-local"
                              id="deliveryTime"
                              min={minTime}
                              className={inputClassName}
                              {...register("deliveryTime", {
                                required:
                                  "Thời gian nhận hàng là trường bắt buộc",
                              })}
                            />
                            {errors?.deliveryTime?.message && (
                              <p className={errorClassName}>
                                {errors.deliveryTime.message}
                              </p>
                            )}
                          </div>
                        </div>
                      </div>

                      <div className={formGroupClassName}>
                        <div className={inputGroupClassName}>
                          <label
                            className={labelClassName}
                            htmlFor="shipmentDetails"
                          >
                            Chi tiết đơn hàng{" "}
                            <span className="text-red-500">*</span>
                          </label>
                          <div className="flex-1">
                            <textarea
                              id="shipmentDetails"
                              className={`${inputClassName} min-h-[80px] resize-y`}
                              placeholder="Nhập chi tiết về đơn hàng của bạn (kích thước, số lượng, yêu cầu đặc biệt...)"
                              {...register("shipmentDetails", {
                                required:
                                  "Chi tiết đơn hàng là trường bắt buộc",
                              })}
                            />
                            {errors?.shipmentDetails?.message && (
                              <p className={errorClassName}>
                                {errors.shipmentDetails.message}
                              </p>
                            )}
                          </div>
                        </div>
                      </div>

                      <div className={formGroupClassName}>
                        <div className={inputGroupClassName}>
                          <label
                            className={labelClassName}
                            htmlFor="deliveryInstruction"
                          >
                            Hướng dẫn giao hàng
                          </label>
                          <div className="flex-1">
                            <textarea
                              id="deliveryInstruction"
                              className={`${inputClassName} min-h-[80px] resize-y`}
                              placeholder="Nhập hướng dẫn giao hàng chi tiết (địa điểm cụ thể, giờ giao hàng ưu tiên...)"
                              {...register("deliveryInstruction")}
                            />
                            {errors?.deliveryInstruction?.message && (
                              <p className={errorClassName}>
                                {errors.deliveryInstruction.message}
                              </p>
                            )}
                          </div>
                        </div>
                      </div>
                    </>
                  )}
                </div>

                <div className="mt-8 flex justify-end border-t pt-6">
                  <button
                    type="submit"
                    className="rounded-lg bg-blue-600 px-8 py-3 text-base font-medium text-white shadow-md transition-all duration-200 hover:bg-blue-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50"
                  >
                    Xác nhận đặt hàng
                  </button>
                </div>
              </form>
            </div>

            <div className="lg:col-span-4">
              <div className="sticky top-4 rounded-xl bg-white p-6 shadow-xl transition-all duration-300 hover:shadow-2xl">
                <h3 className="mb-6 text-xl font-semibold text-gray-800 border-b border-gray-200 pb-4">
                  Tổng quan đơn hàng
                </h3>

                <div className="mb-6">
                  <div className="flex items-center justify-between text-sm text-gray-600 mb-2">
                    <span>Số lượng sản phẩm:</span>
                    <span className="font-medium">
                      {listMedia.length} sản phẩm
                    </span>
                  </div>
                </div>

                <div className="space-y-4">
                  <div className="flex justify-between py-3 border-b border-gray-100">
                    <span className="text-gray-600">Tổng giá trị</span>
                    <span className="font-medium text-gray-800">
                      {formatNumber(subtotal)}đ
                    </span>
                  </div>

                  <div className="flex justify-between py-3 border-b border-gray-100">
                    <div className="flex items-center">
                      <span className="text-gray-600">VAT</span>
                      <span className="ml-1 text-xs text-gray-500">(10%)</span>
                    </div>
                    <span className="font-medium text-gray-800">
                      {formatNumber((subtotal * 10) / 100)}đ
                    </span>
                  </div>

                  <div className="flex justify-between py-3 border-b border-gray-100">
                    <div className="flex items-center">
                      <span className="text-gray-600">Phí vận chuyển</span>
                      {selectedShippingMethod === "Giao hàng nhanh" && (
                        <span className="ml-2 text-xs px-2 py-1 bg-blue-100 text-blue-700 rounded-full">
                          Express
                        </span>
                      )}
                    </div>
                    <span className="font-medium text-gray-800">
                      {formatNumber(shippingFee)}đ
                    </span>
                  </div>

                  <div className="flex justify-between py-4 border-t-2 border-gray-200">
                    <span className="text-lg font-semibold text-gray-800">
                      Tổng cộng
                    </span>
                    <div className="text-right">
                      <span className="block text-lg font-bold text-blue-600">
                        {formatNumber(subtotal * 1.1 + shippingFee)}đ
                      </span>
                      <span className="text-xs text-gray-500">
                        (Đã bao gồm VAT)
                      </span>
                    </div>
                  </div>
                </div>

                <div className="mt-6 p-4 bg-gray-50 rounded-lg">
                  <div className="flex items-center mb-2">
                    <svg
                      className="w-5 h-5 text-gray-600 mr-2"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth={2}
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                      />
                    </svg>
                    <span className="font-medium text-gray-700">
                      Thông tin vận chuyển
                    </span>
                  </div>
                  <div className="text-sm text-gray-600">
                    <p className="mb-1">
                      Phương thức: {selectedShippingMethod}
                    </p>
                    <p>Địa điểm: {city}</p>
                  </div>
                </div>

                <div className="mt-6 flex items-center justify-center text-sm text-gray-500">
                  <svg
                    className="w-4 h-4 mr-2"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeWidth={2}
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                    />
                  </svg>
                  Thanh toán an toàn & bảo mật
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
//kiên