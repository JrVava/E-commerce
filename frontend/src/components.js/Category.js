import React, { useEffect, useState } from "react"
import { useParams } from "react-router-dom"
import { api } from "../utils/apis";
export default function Category(){
    const params = useParams();
    const [products,setProducts] = useState([]);
    let slug = params.slug;
    // console.log(params.slug)
    const getCategoryProduct = async () => {
        await api.get(`category/${slug}`).then((res) => {
            console.log(res);
        })
    }
    useEffect(() => {
        getCategoryProduct()
    },[])
    return (
        <h1>Category Component</h1>
    )
}