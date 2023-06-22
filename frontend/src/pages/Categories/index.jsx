import React, { useState } from "react";

import Toast from "components/molecules/Toast/index";
import Aside from "components/organisms/Aside/index";
import Input from "components/molecules/Input";
import Button from "components/atoms/Button";
import Line from "components/molecules/Line";

import "./index.scss";
import useFetchData from "hooks/useFetchData";
import Icon from "components/atoms/Icon/index";
import { productTypeIconMap } from "utils/productTypeIconMap";
import { makeRequest } from "services/api";
import List from "components/organisms/List/index";
import Title from "components/atoms/Title/index";

export default function Categories() {
  const [name, setName] = useState("");
  const [percentage, setPercentage] = useState("");

  const handleNameChange = (event) => {
    setName(event.target.value);
  };

  const handlePercentageChange = (event) => {
    setPercentage(event.target.value);
  };

  const handleSubmit = async (event) => {
    event.preventDefault();

    const typeResponse = await makeRequest(
      "http://localhost:8080/product-type",
      "POST",
      { name },
      "Categoria registrada."
    );

    if (typeResponse?.ok) {
      const newType = await typeResponse.json();
      const typeId = newType.data.id;

      await makeRequest(
        "http://localhost:8080/sales",
        "POST",
        { type_id: typeId, percentage },
        "Impostos atrelados ao tipo."
      );

      setName("");
      setPercentage("");
    }
  };

  const { data, loading } = useFetchData("http://localhost:8080/product-type");

  if (loading) {
    return <div>Loading</div>;
  }

  return (
    <section className="Container">
      <div>
        <Title>Categorias</Title>

        <List>
          {data.data.map((productTypes) => {
            const icon = productTypeIconMap[productTypes.name];

            return (
              <div key={productTypes.id}>
                <Line>
                  <div className="Line-icon">
                    <Icon icon={icon} />
                    <h2>{productTypes.name}</h2>
                  </div>
                  <p>Porcentagem de impostos: 8%</p>
                </Line>
              </div>
            );
          })}
        </List>
      </div>

      <Aside>
        <Toast />
        <h2>Nova categoria</h2>
        <form className="Categories-form" onSubmit={handleSubmit}>
          <Input
            icon="GiPencil"
            type="text"
            placeholder="Nome"
            id="name"
            value={name}
            onChange={handleNameChange}
          />

          <Input
            icon="AiOutlinePercentage"
            placeholder="Porcentagem de impostos"
            type="number"
            id="percentage"
            value={percentage}
            onChange={handlePercentageChange}
          />

          <Button name="Registrar" type="submit">
            Registrar
          </Button>
        </form>
      </Aside>
    </section>
  );
}
