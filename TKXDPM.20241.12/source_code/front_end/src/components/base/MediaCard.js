import Card from "@mui/material/Card";
import CardActions from "@mui/material/CardActions";
import CardContent from "@mui/material/CardContent";
import CardMedia from "@mui/material/CardMedia";
import Button from "@mui/material/Button";
import Chip from "@mui/material/Chip";
import { FaStar } from "react-icons/fa";
import { AiFillThunderbolt } from "react-icons/ai";
import { Link } from "react-router-dom";
import { ProductService } from "../../services/products.service";
import { CartService } from "../../services/cart.service";
import ToastUtil from "../../common/utils";
import { useNumProduct } from "../../features/carts/NumProductInCartContext";
import { useCart } from "../../features/carts/CartContext";
import { useEffect, useState } from "react";
import { formatNumber } from "../../common/utils";

export default function MediaCard({ product }) {
  const { updateNumProduct, numProduct } = useNumProduct();
  const { addMediaToCart } = useCart();
  const [medias, setMedias] = useState();
  return (
    <>
      {ToastUtil.initializeToastContainer()}
      <Link
        to={`products/${product.id}`}
        className="block"
        style={{ textDecoration: "none" }}
      >
        <Card
          sx={{
            width: 270,
            height: 420,
            transition: "transform 0.15s ease",
            "&:hover": {
              transform: "translateY(-4px)",
              boxShadow: "0 8px 20px rgba(0,0,0,0.25)",
            },
            display: "flex",
            flexDirection: "column",
            position: "relative",
            borderRadius: "12px",
            overflow: "hidden",
            border: "1px solid rgba(0, 0, 0, 0.1)",
            boxShadow: "0 4px 10px rgba(0,0,0,0.15)",
          }}
        >
          {/* Badge giảm giá - điều chỉnh vị trí */}
          <div
            style={{
              position: "absolute",
              top: 12,
              left: 16, // Tăng left lên một chút
              zIndex: 1,
              background: "linear-gradient(45deg, #DC2626, #EF4444)",
              color: "white",
              padding: "6px 12px",
              borderRadius: "20px",
              fontSize: "13px",
              fontWeight: "bold",
              boxShadow: "0 2px 8px rgba(220, 38, 38, 0.2)",
              display: "flex",
              alignItems: "center",
              gap: "4px",
            }}
            onClick={(e) => e.preventDefault()} // Ngăn chặn navigation khi click vào badge
          >
            <AiFillThunderbolt size={14} />
            {(((product.value - product.price) * 100) / product.value).toFixed(
              0
            )}
            %
          </div>

          {/* Container cho ảnh và thông tin cơ bản */}
          <div className="flex p-4 gap-4">
            {/* Ảnh sách - bỏ Link bao quanh */}
            <div className="flex-shrink-0">
              <CardMedia
                sx={{
                  width: 140,
                  height: 200,
                  backgroundSize: "contain",
                  borderRadius: "8px",
                  transition: "transform 0.2s",
                  "&:hover": {
                    transform: "scale(1.05)",
                  },
                }}
                image={product.imageUrl}
              />
            </div>

            {/* Thông tin bên phải */}
            <div className="flex flex-col gap-3 min-w-0">
              {/* Tên sách */}
              <div className="font-semibold text-base text-gray-800 hover:text-blue-600">
                <div className="line-clamp-2 break-words">{product.title}</div>
              </div>

              {/* Rating */}
              <div className="flex items-center gap-2 flex-wrap">
                <div className="flex text-yellow-400 flex-shrink-0">
                  <FaStar size={14} />
                  <FaStar size={14} />
                  <FaStar size={14} />
                  <FaStar size={14} />
                  <FaStar size={14} />
                </div>
                <span className="text-sm text-gray-500">(4.5)</span>
              </div>

              {/* Shipping */}
              <Chip
                sx={{
                  height: "24px",
                  fontSize: "12px",
                  background: "#10B981",
                  color: "white",
                  maxWidth: "100%",
                  "& .MuiChip-label": {
                    padding: "0 10px",
                    fontWeight: 500,
                    display: "block",
                    overflow: "hidden",
                    textOverflow: "ellipsis",
                    whiteSpace: "nowrap",
                  },
                }}
                label={
                  product?.isRush ? "Giao hàng nhanh" : "Giao hàng tiêu chuẩn"
                }
              />
            </div>
          </div>

          {/* Phần thông tin giá và button */}
          <CardContent
            sx={{
              padding: "16px",
              borderTop: "1px solid #E5E7EB",
              mt: "auto",
            }}
          >
            {/* Giá và số lượng */}
            <div className="flex justify-between items-center mb-4 flex-wrap gap-2">
              <div className="flex flex-col gap-1">
                <span className="text-2xl font-bold text-red-600 break-all">
                  ₫{formatNumber(product.price)}
                </span>
                <span className="text-sm text-gray-400 line-through break-all">
                  ₫{formatNumber(product.value)}
                </span>
              </div>
              <div className="text-sm text-emerald-600 font-medium whitespace-nowrap">
                Còn {product?.quantityAvailable ?? 0} cuốn
              </div>
            </div>

            {/* Button */}
            <Button
              fullWidth
              variant="contained"
              sx={{
                textTransform: "none",
                fontSize: "14px",
                fontWeight: 600,
                background: "#2563EB",
                "&:hover": {
                  background: "#1D4ED8",
                },
                borderRadius: "8px",
                padding: "10px",
                minHeight: "42px",
                whiteSpace: "nowrap",
              }}
              onClick={(e) => {
                e.preventDefault();
                addMediaToCart(product);
              }}
            >
              Thêm vào giỏ hàng
            </Button>
          </CardContent>
        </Card>
      </Link>
    </>
  );
}
