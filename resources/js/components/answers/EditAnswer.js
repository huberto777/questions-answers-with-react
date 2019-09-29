import React from "react";

const EditAnswer = props => {
    return (
        <>
            <form onSubmit={props.updateAnswer}>
                <div className="form-group">
                    <textarea
                        className="form-control"
                        rows="7"
                        type="text"
                        name="updateAnswer"
                        defaultValue={props.body}
                    ></textarea>
                </div>
                <div className="form-group">
                    <button
                        type="submit"
                        className="btn btn-block btn-outline-primary"
                    >
                        update
                    </button>
                    <button
                        onClick={props.editAnswer}
                        className="btn btn-block btn-outline-danger"
                    >
                        cancel
                    </button>
                </div>
            </form>
        </>
    );
};

export default EditAnswer;
