import React, { useState } from "react";

import { makeRequest } from "services/api";
import useFetchData from "hooks/useFetchData";
import Aside from "components/organisms/Aside/index";
import Button from "components/atoms/Button";
import Input from "components/molecules/Input";
import Select from "components/molecules/Select";
import Title from "components/atoms/Title/index";
import List from "components/organisms/List/index";
import Toast from "components/molecules/Toast/index";
import ProductCard from "components/molecules/ProductCard/index";
import ProductGrid from "components/organisms/ProductGrid/index";

import "styles/container.scss";
import "./index.scss";

export default function Product() {
  const [name, setName] = useState("");
  const [typeId, setTypeId] = useState("");
  const [price, setPrice] = useState("");

  const handleNameChange = (event) => {
    setName(event.target.value);
  };

  const handleTypeChange = (event) => {
    setTypeId(event.target.value);
  };

  const handlePriceChange = (event) => {
    setPrice(event.target.value);
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    const newProduct = { name, type_id: typeId, price };

    const response = await makeRequest(
      "http://localhost:8080/products",
      "POST",
      newProduct,
      "Produto registrado."
    );

    if (!response) return;

    setName("");
    setTypeId("");
    setPrice("");
  };

  const { data, loading } = useFetchData("http://localhost:8080/product-type");
  const response = useFetchData("http://localhost:8080/products");

  if (loading || response.loading) {
    return <>loading</>;
  }

  const productTypes = data.data;

  return (
    <section className="Products Container">
      <div>
        <Title>Produtos</Title>
        <List>
          <ProductGrid>
            {response.data.data.map((product) => (
              <ProductCard key={product.name} product={product} />
            ))}
          </ProductGrid>
        </List>
      </div>
      <Aside>
        <h2>Registrar novo produto</h2>
        <form className="Products-form" onSubmit={handleSubmit}>
          <Input
            placeholder="Nome"
            icon="GiPencil"
            type="text"
            id="name"
            value={name}
            onChange={handleNameChange}
          />

          <div>
            <Select
              options={productTypes}
              value={typeId}
              onChange={handleTypeChange}
              label="Selecione um tipo"
            />
          </div>

          <Input
            label="Preço"
            icon="GiPriceTag"
            type="number"
            placeholder="Preço"
            id="price"
            value={price}
            onChange={handlePriceChange}
          />
          <Button name="Registrar" type="submit">
            Registrar
          </Button>
        </form>
        <Toast />
      </Aside>
    </section>
  );
}
