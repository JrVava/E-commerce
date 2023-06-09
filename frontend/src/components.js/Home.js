import { useEffect, useState } from "react";
import { api } from "../utils/apis";
import Card from 'react-bootstrap/Card';
import SimpleImageSlider from "react-simple-image-slider";
import { Link } from "react-router-dom"
export default function Home (){
    const [rootId,setRootId] = useState();
    const [products, setProducts] = useState([]);
    const [loading,setLoading] = useState(true);
    const getCategories  = async () => {
      await api.get('categories').then((response) => {
            for(let i = 0; i < response.data.categories.length; i++) {
                setRootId(response.data.categories[i].uuid)
            }
      });
    }
    const getCategoryProduct = async () => {
        // console.log(rootId);
        
            await api.get(`category/${rootId}`).then((res) => {
                setProducts(res.data.productDetails)
                setLoading(false);
            })
        
    }
    useEffect(() => {
            if(rootId !== undefined){
                getCategoryProduct()
            }
        }, [rootId])
    useEffect(()=>{
      getCategories()
    },[])
    // console.log(products);
    return (
        <div className="container">
            {
                loading ? "Loading Please Wait..." : 
            
           <div className="row" >
                {
                    products.product && (
                        products.product.map((product, index) => {
                            return (
                                <div className="col-4" key={index}>
                                    <Card style={{ width: '18rem' }}>
                                        <Card.Body >
                                            <SimpleImageSlider
                                                width={230}
                                                height={250}
                                                images={product.media}
                                                slideDuration={0.5}
                                                autoPlay={true}
                                            />
                                            <Card.Title>{product.name}</Card.Title>
                                            <Card.Text dangerouslySetInnerHTML={{ __html: product.short_decription }}>
                                            </Card.Text>
                                            <Card.Subtitle className="mb-2 text-muted">${product.price}</Card.Subtitle>
                                            <Link  to={`../product-details/${product.uuid}`} className="btn btn-primary">More details</Link>
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