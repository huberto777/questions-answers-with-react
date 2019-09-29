import React from "react";

const Author = props => {
    const { created_date, user } = props.answer;
    // console.log(props.answer);
    return (
        <>
            <span className="text-muted">answered: {created_date}</span>
            <div className="media mt-2">
                <a href="#" className="pr-2 img-fluid">
                    <img src={user.avatar} className="img-fluid" />
                </a>
                <div className="media-body mt-1">
                    <a href="#">{user.name}</a>
                </div>
            </div>
        </>
    );
};

export default Author;
