import React, { useState } from "react";

import useFetchData from "hooks/useFetchData";
import formatDate from "utils/formatDate";
import ProductGrid from "components/organisms/ProductGrid";
import ProductCard from "components/molecules/ProductCard";
import Cart from "components/organisms/Cart";

import "styles/container.scss";
import "./index.scss";
import Aside from "components/organisms/Aside/index";

export default function Cashier() {
  const currentDate = formatDate(new Date());
  const [selectedProducts, setSelectedProducts] = useState([]);

  const handleProductClick = (product) => {
    const isProductSelected = selectedProducts.some(
      (selectedProduct) => selectedProduct.name === product.name
    );

    if (!isProductSelected) {
      const productWithQuantity = {
        ...product,
        quantity: 1,
      };

      setSelectedProducts((prevSelectedProducts) => [
        ...prevSelectedProducts,
        productWithQuantity,
      ]);
    }
  };

  const { data, loading, error } = useFetchData(
    "http://localhost:8080/products"
  );

  if (loading) {
    return <>loading</>;
  }

  const products = data.data;

  return (
    <section className="Cashier Container">
      <section>
        <header className="Cashier-header">
          <h1>Nova venda</h1>
          <time>{currentDate}</time>
        </header>
        <ProductGrid>
          {products.map((product) => (
            <ProductCard
              key={product.name}
              onClick={() => handleProductClick(product)}
              product={product}
            />
          ))}
        </ProductGrid>
      </section>

      <Aside>
        <Cart
          selectedProducts={selectedProducts}
          setSelectedProducts={setSelectedProducts}
        />
      </Aside>
    </section>
  );
}
