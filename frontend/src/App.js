import React,{useEffect, useState} from 'react'
import Navbars from './Navbars';
import { BrowserRouter, Route, Routes } from "react-router-dom";
// import Category from './components.js/Category';
import ProductByCategorySlug from './components.js/ProductByCategorySlug';
import ProductDetails from './components.js/ProductDetails';
import Home from './components.js/Home';
import Product from './components.js/Product';
import { MyContextProvider } from './components.js/MyContextProvider';

function App() {
  return (
    <div className="App">
       
      <BrowserRouter>
          <Navbars />
          <hr />
          <Routes>
          <Route path="/" element={<Home />} />
          
            <Route path="/products" element={<MyContextProvider><Product /></MyContextProvider>} />
            
            <Route path="/category/:uuid" element={<ProductByCategorySlug />} />
            <Route path="/product-details/:uuid" element={<ProductDetails />} />
          </Routes>
        </BrowserRouter>
        {/* </MyContextProvider> */}
      {/* <Navbar/> */}
    </div>
  );
}

export default App;
