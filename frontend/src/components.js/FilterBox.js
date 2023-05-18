import React, { Fragment, useContext, useEffect, useState } from "react";
import { api } from "../utils/apis";
import MyContext from "./MyContextProvider"
export default function FilterBox() {
    const [categories, setCategories] = useState([]);
    const [load, setLoad] = useState(true);
   
    let { filterHandler,buttonHandler,filterFieldsData,clearFilters } = useContext(MyContext);


    const getCategoryList = async () => {
        await api.get(`category-list`).then((res) => {
            setCategories(res.data.categories);
            setLoad(false)
            // setResult()
        })
    }
    useEffect(() => {
        getCategoryList()

    }, [])
    
    return (
        <div className="row mb-4">
            {
                load ? "Please while Categories is loading wait..." :(
                    <>
                    <div className="col-4">
                        <label className="mb-1">Category</label>
                        <select name="category" onChange={filterHandler} value={filterFieldsData.category} className="form-control">
                            <option value="">--Filter by category--</option>
                            {
                                categories.map((categories, index) => {
                                    return (
                                        <Fragment key={index}>
                                            {
                                                categories.slug !== "root" &&
                                                <option value={categories.uuid} >{categories.title}</option>
                                            }
                                        </Fragment>
                                    )
                                })
                            }
                        </select>
                    </div>
                    <div className="col-2">
                        <label className="mb-1">Product</label>
                        <input type="text" placeholder="Filter by product" className="form-control" name="product" onChange={filterHandler} />
                    </div>
                    <div className="col-2">
                        <label className="mb-1">Price</label>
                        <input type="text" placeholder="Filter by price" className="form-control" name="price" onChange={filterHandler} />
                    </div>
                    <div className="col-2">
                        <button type="button" className="btn btn-primary mt-4" onClick={buttonHandler} >Submit</button>
                    </div>
                    <div className="col-2">
                        <button type="button" className="btn btn-primary mt-4" onClick={clearFilters} >Clear</button>
                    </div>
                    </>
                    )
            }
        </div>
    )
}