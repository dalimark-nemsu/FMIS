<script setup>
import { defineProps, ref, computed, onMounted, watch } from "vue";
import { useDebounceFn } from "@vueuse/core"; // Import debounce from @vueuse/core
import axios from "axios";
import Swal from "sweetalert2";
import BaseButton from "./BaseButton.vue";

const shoppingCart = ref([]); // Holds the cart items
const products = ref([]); // Product list for the current page
const totalRecords = ref(0); // Total number of records from the server
const searchQuery = ref(""); // Search filter input
const currentPage = ref(1); // Current page number
const pageSize = ref(10); // Number of items per page

const offcanvasRef = ref(null); // Offcanvas reference
const maxVisiblePages = 5; // Maximum visible pagination links

// Expose props and emits
const emit = defineEmits(["add-items"]); // Emit event to parent component

const props = defineProps({
  activityId: {
    type: Number,
    required: true,
  },
});

console.log("Received activityId in ShoppingFormOffcanvas:", props.activityId);

// Fetch products for the current page
async function fetchProducts() {
  try {
    const response = await axios.get("/api/products", {
      params: {
        page: currentPage.value,
        pageSize: pageSize.value,
        search: searchQuery.value,
      },
    });
    products.value = response.data.data.map((item) => ({
      id: item.id,
      photo: item.photo || "https://via.placeholder.com/100",
      code: item.product_code,
      description: item.product_description,
      unit: item.uom,
      price: parseFloat(item.price || 0),
    }));
    totalRecords.value = response.data.total; // Update total record count
    currentPage.value = response.data.current_page; // Ensure current page sync
  } catch (error) {
    console.error("Error fetching products:", error);
  }
}

// Compute total number of pages
const totalPages = computed(() => Math.ceil(totalRecords.value / pageSize.value));

// Compute visible page range for pagination
const paginationRange = computed(() => {
  const range = [];
  const startPage = Math.max(currentPage.value - Math.floor(maxVisiblePages / 2), 1);
  const endPage = Math.min(startPage + maxVisiblePages - 1, totalPages.value);

  for (let i = startPage; i <= endPage; i++) {
    range.push(i);
  }
  return range;
});

// Debounced version of fetchProducts
const debouncedFetchProducts = useDebounceFn(() => {
  currentPage.value = 1; // Reset to first page on new search
  fetchProducts();
}, 300); // Adjust the debounce delay (300ms is common)

// Watch searchQuery with debounce
watch(searchQuery, () => debouncedFetchProducts());

// Watch currentPage to fetch products
watch(currentPage, () => fetchProducts());

// Format price with commas
function formatPrice(price) {
  return new Intl.NumberFormat("en-PH").format(price);
}

// Pagination: Change page handler
function changePage(page) {
  if (page > 0 && page <= totalPages.value) {
    currentPage.value = page;
  }
}

// Add product to cart
function addToCart(product) {
  if (!product || !product.id) {
    console.error("Invalid product selected.");
    return;
  }

  const exists = shoppingCart.value.find((item) => item.id === product.id);
  if (exists) {
    exists.quantity += 1; // Increment quantity if the product already exists in the cart
  } else {
    shoppingCart.value.push({ ...product, quantity: 1 }); // Add new product with default quantity 1
  }
}

// Open and close Offcanvas
// function openOffcanvas() {
//   const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasRef.value) || new bootstrap.Offcanvas(offcanvasRef.value);
//   offcanvas.show();
// }
function openOffcanvas(id) {
  console.log("Opening offcanvas with activityId:", id);
  const offcanvas =
    bootstrap.Offcanvas.getInstance(offcanvasRef.value) ||
    new bootstrap.Offcanvas(offcanvasRef.value);
  if (offcanvas) {
    offcanvas.show();
  } else {
    console.error("Bootstrap Offcanvas instance not initialized.");
  }
}



function closeOffcanvas() {
  const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasRef.value);
  if (offcanvas) offcanvas.hide();
}

// Emit selected items to parent
// async function handleAddToItems() {
//     if (!props.activityId) {
//         Swal.fire("Error", "Activity ID is required to save cart items.", "error");
//         return;
//     }

//     // Prepare the payload with only the required fields
//     const payload = {
//         cartItems: shoppingCart.value.map((item) => ({
//             general_description: item.description,
//             uom: item.unit,
//             quantity: item.quantity,
//             unit_cost: item.price,
//         })),
//     };

//     console.log("Prepared Payload:", payload); // Log the payload for debugging

//     try {
//         // Send the payload to the server
//         const response = await axios.post(`/activities/${props.activityId}/cart-items`, payload);

//         // Handle success
//         Swal.fire("Success", response.data.message, "success");
//         shoppingCart.value = []; // Clear the cart after saving
//         closeOffcanvas(); // Close the offcanvas
//     } catch (error) {
//         // Log error for debugging
//         console.error("Error saving cart items:", error.response?.data || error.message);

//         // Display error notification
//         Swal.fire("Error", "Failed to save items. Please try again.", "error");
//     }
// }
async function handleAddToItems() {
    if (!props.activityId) {
        Swal.fire("Error", "Activity ID is required to save cart items.", "error");
        return;
    }

    // Prepare the payload with only the required fields
    const payload = {
        cartItems: shoppingCart.value.map((item) => ({
            general_description: item.description,
            uom: item.unit,
            quantity: item.quantity,
            unit_cost: item.price,
        })),
    };

    console.log("Prepared Payload:", payload); // Log the payload for debugging

    try {
        // Send the payload to the server
        const response = await axios.post(`/activities/${props.activityId}/cart-items`, payload);

        // Emit the items back to the parent component
        emit("add-items", payload.cartItems);

        // Handle success
        Swal.fire("Success", response.data.message, "success");
        shoppingCart.value = []; // Clear the cart after saving
        closeOffcanvas(); // Close the offcanvas
    } catch (error) {
        console.error("Error saving cart items:", error.response?.data || error.message);
        Swal.fire("Error", "Failed to save items. Please try again.", "error");
    }
}


// Update quantity of an item in the cart
function updateQuantity(item, newQuantity) {
  newQuantity = parseInt(newQuantity, 10);
  if (newQuantity > 0) {
    item.quantity = newQuantity;
  } else {
    removeFromCart(item); // Remove if quantity becomes 0 or less
  }
}

// Remove an item from the cart
function removeFromCart(item) {
  const index = shoppingCart.value.findIndex((cartItem) => cartItem.id === item.id);
  if (index !== -1) {
    shoppingCart.value.splice(index, 1);
  }
}

// Fetch initial products on component mount
onMounted(() => fetchProducts());

// Expose methods for external calls
defineExpose({ openOffcanvas, closeOffcanvas });
</script>


<template>
  <div class="offcanvas offcanvas-end" tabindex="-1" ref="offcanvasRef">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Shopping</h5>
      <button type="button" class="btn-close" aria-label="Close" @click="closeOffcanvas"></button>
    </div>

    <div class="offcanvas-body">
      <!-- Search Box -->
      <div class="search-box mb-4">
        <input
          type="text"
          class="form-control search-input"
          placeholder="Search products by description or code"
          v-model="searchQuery"
        />
      </div>

      <!-- Product Table -->
      <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th class="text-center">Photo</th>
            <th>Description</th>
            <th class="text-center">Unit</th>
            <th class="text-end">Price</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <td class="text-center">
              <img :src="product.photo" alt="Product Image" class="product-photo" />
            </td>
            <td>
              <strong>{{ product.description }}</strong>
              <div class="text-muted small">{{ product.code }}</div>
            </td>
            <td class="text-center">{{ product.unit }}</td>
            <td class="text-end">₱{{ formatPrice(product.price) }}</td>
            <td class="text-center">
              <button
                class="btn btn-success btn-sm"
                @click="addToCart(product)"
                title="Add to Cart"
              >
                <i class="fas fa-cart-plus"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Pagination -->
      <nav aria-label="Page navigation" class="pagination mt-2 d-flex justify-content-center">
        <ul class="pagination">
          <li :class="['page-item', currentPage === 1 ? 'disabled' : '']">
            <button class="page-link" @click="changePage(currentPage - 1)">
              <i class="fas fa-angle-left"></i>
            </button>
          </li>
          <li
            v-for="page in paginationRange"
            :key="page"
            :class="['page-item', currentPage === page ? 'active' : '']"
          >
            <button class="page-link" @click="changePage(page)">{{ page }}</button>
          </li>
          <li :class="['page-item', currentPage === totalPages ? 'disabled' : '']">
            <button class="page-link" @click="changePage(currentPage + 1)">
              <i class="fas fa-angle-right"></i>
            </button>
          </li>
        </ul>
      </nav>

      <!-- Shopping Cart -->
      <div v-if="shoppingCart.length > 0" class="shopping-cart">
        <h6 class="mb-4 text-primary fw-bold">Your Shopping Cart</h6>
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <div class="table-container">
              <table class="table align-middle table-hover">
                <thead class="table-light">
                  <tr>
                    <th>Description</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Total</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in shoppingCart" :key="item.id" class="cart-item-row">
                    <td>
                      <div class="d-flex flex-column">
                        <strong>{{ item.description }}</strong>
                        <small class="text-muted">{{ item.code }}</small>
                      </div>
                    </td>
                    <td class="text-center">
                      <div class="input-group input-group-sm justify-content-center">
                        <button
                          class="btn btn-outline-secondary"
                          @click="updateQuantity(item, item.quantity - 1)"
                          type="button"
                        >
                          <i class="fas fa-minus"></i>
                        </button>
                        <input
                          type="number"
                          class="form-control text-center"
                          :value="item.quantity"
                          @change="updateQuantity(item, $event.target.value)"
                          min="1"
                        />
                        <button
                          class="btn btn-outline-secondary"
                          @click="updateQuantity(item, item.quantity + 1)"
                          type="button"
                        >
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </td>
                    <td class="text-end">₱{{ formatPrice(item.price) }}</td>
                    <td class="text-end fw-bold text-primary">
                      ₱{{ formatPrice(item.quantity * item.price) }}
                    </td>
                    <td class="text-center">
                      <button
                        class="btn btn-danger btn-sm"
                        @click="removeFromCart(item)"
                        title="Remove Item"
                      >
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <strong>Total:</strong>
                <span class="fs-4 text-primary fw-bold">
                    ₱{{ shoppingCart.reduce((sum, item) => sum + item.quantity * item.price, 0).toLocaleString() }}
                </span>
              </div>
              <button variant="primary" size="lg" @click="handleAddToItems">Add to Items</button>
            </div>
          </div>
        </div>
      </div>

      <div v-else class="text-center mt-4">
        <p class="text-muted">Your cart is empty.</p>
      </div>
    </div>
  </div>
</template>


<style scoped>
/* General Layout */
.offcanvas {
  width: 100%;
  max-width: 900px;
  background-color: #fff;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.search-box {
  display: flex;
  justify-content: center;
}

.search-input {
  max-width: 400px;
  border-radius: 8px;
}

/* Product Table */
.product-photo {
  width: 50px;
  height: 50px;
  object-fit: cover;
  border-radius: 4px;
}

.table {
  margin-bottom: 0;
  font-size: 15px;
  border-collapse: separate;
  border-spacing: 0;
  border-radius: 8px;
  overflow: hidden;
}

.table th,
.table td {
  vertical-align: middle;
}

.table thead th {
  text-transform: uppercase;
  font-size: 14px;
  color: #6c757d;
  position: sticky;
  top: 0;
  background-color: #f8f9fa;
  z-index: 1;
}

.table-borderless th,
.table-borderless td {
  border: none;
}

.cart-item-row:hover {
  background-color: #f8f9fa;
}

/* Pagination */
.pagination {
  display: flex;
  justify-content: center;
  gap: 5px;
  font-size: 14px;
}

.page-item .page-link {
  padding: 6px 12px;
  border-radius: 4px;
  border: 1px solid #dee2e6;
  color: #495057;
}

.page-item.active .page-link {
  background-color: #4a69bd;
  color: white;
  border-color: #4a69bd;
}

/* Shopping Cart */
.shopping-cart {
  margin-top: 1rem;
}

.table-container {
  max-height: 200px;
  overflow-y: auto;
}

.table-container::-webkit-scrollbar {
  width: 6px;
}

.table-container::-webkit-scrollbar-thumb {
  background-color: #ced4da;
  border-radius: 3px;
}

.table-container::-webkit-scrollbar-thumb:hover {
  background-color: #adb5bd;
}

/* Buttons */
.btn-outline-secondary {
  font-size: 14px;
  padding: 0.25rem 0.5rem;
}

.btn-outline-danger {
  color: #dc3545;
  border-color: #dc3545;
}

.btn-outline-danger:hover {
  background-color: #dc3545;
  color: white;
}

.btn-danger {
  font-size: 14px;
  padding: 0.25rem 0.75rem;
}

/* Typography */
.quantity-label,
.item-total,
.table th,
.table td {
  font-size: 14px;
}

.fs-4 {
  font-size: 1.5rem;
}

.text-primary {
  color: #4a69bd !important;
}

.total-amount {
  font-size: 20px;
  font-weight: bold;
  color: #4a69bd;
}

.item-total .fw-bold {
  font-size: 16px; /* Slightly larger for emphasis */
}

/* Inputs */
.input-group-sm input {
  width: 50px;
  text-align: center;
}

/* Cards */
.card {
  border-radius: 10px;
}

.card-body,
.card-footer {
  padding: 1rem 1.5rem;
}

.card-footer {
  border-top: 1px solid #dee2e6;
}
</style>
