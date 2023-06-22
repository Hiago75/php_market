import React from "react";

import useFetchData from "hooks/useFetchData";
import Line from "components/molecules/Line";
import Icon from "components/atoms/Icon/index";
import List from "components/organisms/List/index";
import Title from "components/atoms/Title/index";

import "./index.scss";

export default function Transactions() {
  const { data, loading } = useFetchData("http://localhost:8080/sales");
  if (loading) return <>Loading...</>;

  return (
    <section className="Transactions Container">
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
                  <p>Subtotal: R${sale.subtotal}</p>
                  <p>Impostos: R${sale.taxes}</p>
                  <p>Total: R${sale.total}</p>
                </div>
                <time>{formatedDate}</time>
              </Line>
            );
          })}
        </List>
      </div>
    </section>
  );
}
