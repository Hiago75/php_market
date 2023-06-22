import React from "react";

import useFetchData from "hooks/useFetchData";
import Line from "components/molecules/Line";
import Icon from "components/atoms/Icon/index";
import Aside from "components/organisms/Aside/index";
import List from "components/organisms/List/index";
import Title from "components/atoms/Title/index";

export default function Transactions() {
  const { data, loading } = useFetchData("http://localhost:8080/sales");

  if (loading) return <>Loading...</>;
  const mockProduct = data.data[0];

  return (
    <section className="Container">
      <div>
        <Title>Transações</Title>
        <List>
          {data.data.map((sale) => {
            const formatedDate = new Date(sale.sale_date).toLocaleDateString(
              "pt-BR"
            );

            return (
              <Line key={sale.id}>
                <div className="Line-icon">
                  <Icon icon="GiShoppingCart" />
                  <p>R${sale.total}</p>
                </div>
                <time>{formatedDate}</time>
              </Line>
            );
          })}
        </List>
      </div>

      <Aside>
        <h2>Detalhes</h2>

        <h2>{mockProduct.subtotal}</h2>
        <h2>{mockProduct.taxes}</h2>
        <h2>{mockProduct.total}</h2>
      </Aside>
    </section>
  );
}
