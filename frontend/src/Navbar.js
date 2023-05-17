import { Fragment, useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { api } from "./utils/apis";
import CategoryItem from "./components.js/CategoryItem";

const Navbar = () => {
    const [categories, setCategories] = useState([]);
  const getCategories  = async () => {
    await api.get('categories').then((response) => {
        setCategories(response.data.categories);
    });
  }

  useEffect(()=>{
    getCategories()
  },[])

  return (
    <>
      <Link to={"./"}>Home</Link>
      {/* <Link to={"./category"}>Category</Link> */}
      {
        categories.map((category,index) => {
            return (
                <div key={index} className="parent test">
                {/* <Link to={"./category/"+category.id} key={index}>{ category.title }</Link> */}
                <CategoryItem category={category} />
                </div>
            )
        })
      }
    </>
  );
};

export default Navbar;
