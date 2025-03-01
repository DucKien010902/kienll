import axios from "axios";

axios.defaults.baseURL = "http://localhost:9696/tkxdpm/api/v1";
export const ProductService = {
  getAllMedia: async (
    pageSize,
    pageNumber,
    title?: null,
    type?: null,
    sort: ""
  ) => {
    const response = await axios.get("/medias", {
      params: { pageSize, pageNumber, title, type, sort },
    });
    return response;
  },

  getMediaById: async (id) => {
    const response = await axios.get(`/medias/${id}`);
    return response;
  },

  addMediaToCart: async (userId, mediaId, quantity) => {
    const response = await axios.post(`/carts/${userId}`, null, {
      params: { mediaId, quantity },
    });
    return response;
  },
};
