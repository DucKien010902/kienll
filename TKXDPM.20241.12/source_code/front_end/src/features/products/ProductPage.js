import MediaCard from "../../components/base/MediaCard";
import Pagination from "@mui/material/Pagination";
import { useState } from "react";
import { useEffect } from "react";
import Box from "@mui/material/Box";
import InputLabel from "@mui/material/InputLabel";
import MenuItem from "@mui/material/MenuItem";
import FormControl from "@mui/material/FormControl";
import Select, { SelectChangeEvent } from "@mui/material/Select";
import { ProductService } from "../../services/products.service";
import TextField from "@mui/material/TextField";
import { IoSearchSharp } from "react-icons/io5";
import InputBase from "@mui/material/InputBase";
import Divider from "@mui/material/Divider";
import IconButton from "@mui/material/IconButton";
import SearchIcon from "@mui/icons-material/Search";
import Paper from "@mui/material/Paper";
import Radio from "@mui/material/Radio";
import FormControlLabel from "@mui/material/FormControlLabel";

export default function ProductPage() {
  const itemsPerPage = 20;
  const [currentPage, setCurrentPage] = useState(0);
  const [products, setProducts] = useState([]);
  const [category, setCategory] = useState("");
  const [filter, setFilter] = useState("");
  const [search, setSearch] = useState("");
  const [total, setTotal] = useState(0);
  const handleChangeCategory = async (event) => {
    setCategory(event.target.value);

    if (event.target.value === "") {
      const response = await ProductService.getAllMedia(50, 1);
      setProducts(response?.data?.data?.content);
    } else {
      const response = await ProductService.getAllMedia(
        20,
        1,
        null,
        event.target.value
      );

      setProducts(response?.data?.data?.content);
    }
  };
  const handleChangeFilter = async (event) => {
    setFilter(event.target.value);
    const response = await ProductService.getAllMedia(
      20,
      1,
      null,
      null,
      event.target.value
    );
    setProducts(response?.data?.data?.content);
  };
  const handlePageChange = async (event, newPage) => {
    setCurrentPage(newPage - 1);

    const response = await ProductService.getAllMedia(20, newPage);
    setProducts(response?.data?.data?.content);
  };
  const handleSearch = async () => {
    const response = await ProductService.getAllMedia(20, 1, search);
    setProducts(response?.data?.data?.content);
    setTotal(response?.data?.data?.content.length);
  };

  useEffect(() => {
    const getMedia = async () => {
      try {
        const response = await ProductService.getAllMedia(20, 1);
        setProducts(response?.data?.data?.content);
      } catch (error) {
        console.error("Error fetching media:", error);
      }
    };
    const getTotalMedias = async () => {
      const response = await ProductService.getAllMedia(50, 1);
      setTotal(response?.data?.data?.content.length);
    };
    getTotalMedias();
    getMedia();
  }, []);

  const handleKeyPress = (event) => {
    if (event.key === "Enter") {
      handleSearch();
    }
  };

  return (
    <>
      <div className="bg-[#fff] min-h-[500px]">
        <div className="pt-20 text-center text-3xl uppercase font-medium mb-10">
          Danh sách sản phẩm ({total})
        </div>
        <div className="flex px-4">
          <div className="flex flex-col mr-6 w-[280px] bg-white rounded-lg shadow-md p-6 h-fit sticky top-56 z-0">
            <div className="mb-6">
              <div className="flex items-center border rounded-lg overflow-hidden bg-white hover:border-gray-400 transition-colors">
                <InputBase
                  sx={{
                    flex: 1,
                    padding: "8px 12px",
                    fontSize: "0.95rem",
                  }}
                  placeholder="Tìm kiếm sản phẩm..."
                  value={search}
                  onChange={(e) => {
                    setSearch(e.target.value);
                  }}
                  onKeyPress={handleKeyPress}
                />
                <Divider sx={{ height: 28, m: 0.5 }} orientation="vertical" />
                <IconButton
                  type="button"
                  sx={{
                    p: "8px",
                    "&:hover": {
                      backgroundColor: "rgba(0, 0, 0, 0.04)",
                    },
                  }}
                  aria-label="search"
                  onClick={handleSearch}
                >
                  <SearchIcon />
                </IconButton>
              </div>
            </div>

            <div className="mb-6">
              <InputLabel className="font-medium text-gray-700 mb-2">
                Loại sản phẩm
              </InputLabel>
              <div className="radio-group flex flex-col space-y-2 border-t border-b py-3">
                <FormControlLabel
                  control={
                    <Radio
                      checked={category === ""}
                      onChange={handleChangeCategory}
                      value=""
                    />
                  }
                  label="Tất cả"
                />
                <FormControlLabel
                  control={
                    <Radio
                      checked={category === "book"}
                      onChange={handleChangeCategory}
                      value="book"
                    />
                  }
                  label="Sách quyển"
                />
                <FormControlLabel
                  control={
                    <Radio
                      checked={category === "cd"}
                      onChange={handleChangeCategory}
                      value="cd"
                    />
                  }
                  label="Đĩa CD"
                />
                <FormControlLabel
                  control={
                    <Radio
                      checked={category === "lp"}
                      onChange={handleChangeCategory}
                      value="lp"
                    />
                  }
                  label="Đĩa than LP"
                />
                <FormControlLabel
                  control={
                    <Radio
                      checked={category === "dvd"}
                      onChange={handleChangeCategory}
                      value="dvd"
                    />
                  }
                  label="Đĩa DVD"
                />
              </div>
            </div>

            <div className="mb-4">
              <InputLabel className="font-medium text-gray-700 mb-2">
                Sắp xếp theo
              </InputLabel>
              <div className="radio-group flex flex-col space-y-2 border-t border-b py-3">
                <FormControlLabel
                  control={
                    <Radio
                      checked={filter === "desc"}
                      onChange={handleChangeFilter}
                      value="desc"
                    />
                  }
                  label="Từ cao xuống thấp"
                />
                <FormControlLabel
                  control={
                    <Radio
                      checked={filter === "asc"}
                      onChange={handleChangeFilter}
                      value="asc"
                    />
                  }
                  label="Từ thấp đến cao"
                />
              </div>
            </div>
          </div>

          <div className="flex-1">
            {products.length ? (
              <div className="grid grid-cols-12 gap-4 ">
                {products?.map((product, index) => (
                  <div
                    key={product.id}
                    className="col-span-3 mx-auto my-0 min-w-[250px]"
                  >
                    <MediaCard product={product} />
                  </div>
                ))}
              </div>
            ) : (
              <div className="text-center mt-20">Không có sản phẩm nào</div>
            )}
          </div>
        </div>
        <div className="flex justify-center py-6">
          <Pagination
            count={Math.ceil(total / 20)}
            color="primary"
            size="large"
            defaultChecked={true}
            defaultPage={1}
            page={currentPage + 1}
            onChange={handlePageChange}
          />
        </div>
      </div>
    </>
  );
}
