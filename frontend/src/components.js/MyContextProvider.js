import React, { useEffect, useState } from 'react';
import { api } from '../utils/apis';
import { useParams } from 'react-router-dom';
const MyContext = React.createContext({});

export const MyContextProvider = ({ children }) => {
    const [products, setProducts] = useState([]);
    const [loading, setLoading] = useState(true);
    const [message, setMessage] = useState("");
    const [result, setResult] = useState([]);
    const [filterFieldsData, setFilterFieldsData] = useState({});
    const params = useParams();
    const [data,setData] = useState([]);

    let uuid = params.uuid;
    const getProduct = async () => {
        try {
            await api.get(`products`).then((res) => {
                if (res.data.product.length > 0) {
                    setProducts(res.data.product)
                    setResult(res.data.product)
                    setLoading(false)
                } else {
                    setMessage("Sorry, there are no products")
                }
            })
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

 

    const filterHandler = (e) => {
        setFilterFieldsData({
            ...filterFieldsData,
            [e.target.name]: e.target.value
        })
    }
    const buttonHandler = () => {
        filterData()

    }

    const clearFilters = () => {
        getProduct();
    };
    const filterData = () => {
        let answer = result.filter(item =>
            (filterFieldsData.product === '' || item.name.includes(filterFieldsData.product)) ||
             (filterFieldsData.price !== '' && item.price.includes(filterFieldsData.price)) ||
              (filterFieldsData.category !== '' && item.category.some(cat => cat.uuid === filterFieldsData.category))
        )
        setProducts(answer)
        console.log(answer);
    };

    useEffect(() => {
        
        getProduct()
        // console.log(uuid);
    }, [loading])

    const contextValue = {
        products,
        loading,
        message,
        filterHandler,
        buttonHandler,
        filterFieldsData,
        clearFilters,
        result
    };
    return (
        <MyContext.Provider value={contextValue}>
            {children}
        </MyContext.Provider>
    );
};

export default MyContext;