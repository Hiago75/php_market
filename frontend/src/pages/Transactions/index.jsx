import React from "react";

import Line from 'components/molecules/Line';
import Icon from "components/atoms/Icon/index";
import Aside from "components/organisms/Aside/index";
import useFetchData from "hooks/useFetchData";

export default function Transactions() {
  const { data, loading } = useFetchData('http://localhost:8080/sales');

  if(loading) return <>Loading...</>
  const mockProduct = data.data[0]

  return (
    <section className="Container">
        <div>
          {data.data.map(sale => {
              const formatedDate = new Date(sale.sale_date).toLocaleDateString('pt-BR');

              return <Line key={sale.id}>
                <div className='Line-icon'>
                  <Icon icon="GiShoppingCart" />
                  <p>R${sale.total}</p>
                </div>
                <time>{formatedDate}</time>             
              </Line>
            }
          )}
        </div>
      <Aside>
        <h2>Detalhes</h2>

        <h2>{mockProduct.subtotal}</h2>
        <h2>{mockProduct.taxes}</h2>
        <h2>{mockProduct.total}</h2>
      </Aside>
    </section>)
}