import React, { useEffect } from 'react';
import { Link } from "react-router-dom";

import Nav from 'react-bootstrap/Nav';
import NavDropdown from 'react-bootstrap/NavDropdown';

const CategoryItem = ({ category }) => {
    // Check if the category has subcategories
    const handleSelect = (eventKey) => alert(`selected ${eventKey}`)
    const hasSubcategories = category.child && category.child.length > 0;

    return (
        <div className='parent'>
            {
                category.title !== "Root" && (
               
            <div className='child'>
                <Link to={"./category/" + category.uuid} >{category.title}</Link>
            </div>
             )
            }
            {hasSubcategories && (
                <div style={{ display:"flex", justifyContent:"space-around" }}>
                    {category.child.map((child) => (
                        <div key={child.id} style={{ marginLeft: "10px" }}>
                            <CategoryItem category={child} />
                        </div>
                    ))}
                </div>
            )}

        </div>
    );
};

export default CategoryItem;
