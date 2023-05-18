import React, { useContext } from "react";
import MyContext from "./MyContextProvider"
import { Link } from "react-router-dom";
import Card from 'react-bootstrap/Card';
import SimpleImageSlider from "react-simple-image-slider";
import FilterBox from "./FilterBox";
export default function Product() {
    let { products, loading, message } = useContext(MyContext);
    return (
        <div className="container">
            <FilterBox />
            {
                loading ? "Loading Please Wait..!" : message !== "" ? message :
                    <div className="row" >
                        {
                            products && (
                                products.map((product, index) => {
                                    return (
                                        <div className="col-3 m-2" key={index}>
                                            <Card style={{ width: '18rem' }}>
                                                <Card.Body >
                                                    {/* { console.log(product.media) } */}
                                                    {
                                                        product.media &&

                                                        <SimpleImageSlider
                                                            width={230}
                                                            height={250}
                                                            images={product.media}
                                                            slideDuration={0.5}
                                                            autoPlay={true}
                                                        />
                                                    }
                                                    <Card.Title>{product.name}</Card.Title>
                                                    {
                                                        product.category.map((category, index) =>
                                                            <small className="text-muted" key={index}>
                                                                {
                                                                    category !== 'root' &&
                                                                    <Link to={"../category/" + category.uuid} >{category.title}</Link>
                                                                }
                                                                {
                                                                    (index === product.category.length - 1) ? "" : "/"
                                                                }
                                                            </small>
                                                        )
                                                    }

                                                    <Card.Subtitle className="mb-2 text-muted">${product.price}</Card.Subtitle>
                                                    <Link to={`../product-details/${product.uuid}`} className="btn btn-primary">More details</Link>
                                                </Card.Body>
                                            </Card>
                                        </div>
                                    )
                                })
                            )
                        }
                    </div>
            }
        </div>
    )
}