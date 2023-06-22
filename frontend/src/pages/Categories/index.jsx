import React, { useEffect, useState } from "react";

import Toast from "components/molecules/Toast/index";
import Aside from "components/organisms/Aside/index";
import Input from "components/molecules/Input";
import Button from "components/atoms/Button";
import Line from "components/molecules/Line";

import "./index.scss";
import Icon from "components/atoms/Icon/index";
import { productTypeIconMap } from "utils/productTypeIconMap";
import { makeRequest } from "services/api";
import List from "components/organisms/List/index";
import Title from "components/atoms/Title/index";

export default function Categories() {
  const [name, setName] = useState("");
  const [percentage, setPercentage] = useState("");
  const [categories, setCategories] = useState([]);

  const handleNameChange = (event) => {
    setName(event.target.value);
  };

  const handlePercentageChange = (event) => {
    setPercentage(event.target.value);
  };

  const fetchCategories = async () => {
    const response = await makeRequest(
      "http://localhost:8080/product-type",
      "GET"
    );

    if (response) {
      setCategories(response.data);
    }
  };

  const handleSubmit = async (event) => {
    event.preventDefault();

    const typeResponse = await makeRequest(
      "http://localhost:8080/product-type",
      "POST",
      { name },
      "Categoria registrada."
    );

    if (typeResponse) {
      const typeId = typeResponse.data.id;

      await makeRequest(
        "http://localhost:8080/taxes",
        "POST",
        { type_id: typeId, percentage },
        "Impostos atrelados ao tipo."
      );

      setCategories((curr) => [...curr, { name, tax_percentage: percentage }]);

      setName("");
      setPercentage("");
    }
  };

  useEffect(() => {
    fetchCategories();
  }, []);

  return (
    <section className="Container">
      <div>
        <Title>Categorias</Title>

        <List>
          {categories &&
            categories.map((productTypes) => {
              const icon = productTypeIconMap[productTypes.name];

              return (
                <div key={productTypes.id}>
                  <Line>
                    <div className="Line-icon">
                      <Icon icon={icon} />
                      <h2>{productTypes.name}</h2>
                    </div>
                    <p>
                      Porcentagem de impostos: {productTypes.tax_percentage}%
                    </p>
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
