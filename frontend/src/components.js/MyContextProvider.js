import React, { useEffect, useState } from 'react';
import { api } from '../utils/apis';

const MyContext = React.createContext({});

export const MyContextProvider = ({ children }) => {
    const [products, setProducts] = useState([]);
    const [loading, setLoading] = useState(true);
    const [message, setMessage] = useState("");
    const [result, setResult] = useState([]);
    const [filterFieldsData, setFilterFieldsData] = useState({});

    const getProduct = async () => {
        try {
            await api.get(`products`).then((res) => {
                if(res.data.product.length > 0){
                    setProducts(res.data.product)
                    setResult(res.data.product)
                    setLoading(false)
                }else{
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
        console.log(filterFieldsData);
        filterData()
       
    }
//     const filterData = () => {
//         setLoading(true)
//         let data = [];
//         result.filter((product) => {
//             if(product.name === filterFieldsData.product){
//                 product.category.filter((catagory) => {
//                     if (catagory.uuid === filterFieldsData.category) {
//                         data.push(product);
//                     }
//                 })
//             }
//         })
//         setLoading(false)
//         setProducts(data)

// };
const clearFilters = () => {
    // Reset the 'data' state to its original state (e.g., refetch the data from the API)
    // console.log("hello");
    getProduct();
  };
const filterData = () => {
   let answer =  result.filter(item =>
         
        (filterFieldsData.product === '' || item.name.includes(filterFieldsData.product)) || (filterFieldsData.price !== '' && item.price.includes(filterFieldsData.price)) || (filterFieldsData.category !== '' && item.category.some(cat => cat.uuid === filterFieldsData.category))
    )
    setProducts(answer)
   console.log(answer);
};



    useEffect(() => {
        getProduct()
    }, [loading])

    const contextValue = {
        products,
        loading,
        message,
        filterHandler,
        buttonHandler,
        filterFieldsData,
        clearFilters
    };
    return (
        <MyContext.Provider value={contextValue}>
            {children}
        </MyContext.Provider>
    );
};

export default MyContext;