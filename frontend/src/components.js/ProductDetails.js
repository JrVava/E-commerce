import { useContext, useEffect, useState } from 'react';
import Card from 'react-bootstrap/Card';
import MyContext from './MyContextProvider';
import { useParams } from 'react-router-dom';
import SimpleImageSlider from "react-simple-image-slider";
export default function ProductDetails(){
    let { result } = useContext(MyContext);
    // console.log(products,loading);
    const [loading,setLoading] = useState(true);
    const [data,setData] = useState([])
    const params = useParams();
    let uuid = params.uuid;
    const detailProductFun = () => {
        if(result.length > 0 && uuid !== undefined) {
            setLoading(false)
            let res = result.filter(product => product.uuid === uuid)
            setData(res[0])
        }
    }
    useEffect(() => {
            detailProductFun();
        }, [result,uuid]);
    return (
        <div className='container'>
            {
                loading ? "Please wait fetch Product Details..." :
            
          <Card>
            {/* <Card.Img variant="top" src="holder.js/100px180" /> */}
            <SimpleImageSlider
                    width={1000}
                    height={500}
                    images={data.media}
                    slideDuration={0.5}
                    autoPlay={true}
                />
            <Card.Body>
            <Card.Subtitle className="mb-2 text-muted">${data.price}</Card.Subtitle>
              <Card.Text>
                <div dangerouslySetInnerHTML={{__html: data.short_decription}}></div>
              </Card.Text>
              <Card.Text>
                <div dangerouslySetInnerHTML={{__html: data.long_decription}}></div>
              </Card.Text>
            </Card.Body>
          </Card>
          }
        </div>
      );
}