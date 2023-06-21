import Icon from "components/atoms/Icon/index";
import Aside from "components/organisms/Aside/index";
import useFetchData from "hooks/useFetchData";
import React from "react";

export default function Transactions() {
  const { data, loading } = useFetchData('http://localhost:8080/sales');

  if(loading) return <>Loading...</>
  const mockProduct = data.data[0]
  return <section className="Container">
    <section>
      {data.data.map((sale) => (
        <div>
          <Icon />
          <h2>
            R${sale.total} <time>{sale.sale_date}</time> 
          </h2>
        </div>
      ))}
    </section>
    <Aside>
      <h2>Detalhes</h2>

      <h2>{mockProduct.subtotal}</h2>
      <h2>{mockProduct.taxes}</h2>
      <h2>{mockProduct.total}</h2>
    </Aside>
  </section>
}