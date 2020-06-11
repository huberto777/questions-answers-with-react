import React from "react";
import Author from "../Author";
import VoteAnswerItem from "./VoteAnswerItem";
import AcceptAnswerItem from "./AcceptAnswerItem";
import EditAnswer from "./EditAnswer";

const AnswerItem = ({
    auth,
    answer,
    name,
    onEdit,
    onDelete,
    onUpdate,
    onCancel,
    currentEditAnswer,
    editMode
}) => {
    // console.log(answer.user.id);
    const handleButtons = () => {
        if (auth.id === answer.user.id) {
            return (
                <>
                    <button
                        onClick={onEdit}
                        className="btn btn-sm mr-1 btn-outline-primary"
                        disabled={editMode}
                    >
                        <i className="far fa-edit" />
                    </button>
                    <button
                        className="btn btn-sm btn-outline-danger"
                        onClick={onDelete}
                        disabled={editMode}
                    >
                        <i className="far fa-trash-alt" />
                    </button>
                </>
            );
        }
    };
    return (
        <>
            {currentEditAnswer === answer.id ? (
                <EditAnswer
                    answer={answer}
                    onUpdate={onUpdate}
                    onCancel={onCancel}
                />
            ) : (
                <div className="media post">
                    <div className="d-fex flex-column vote-controls">
                        <div className="vote">
                            <VoteAnswerItem
                                auth={auth}
                                answer={answer}
                                name={name}
                                isVoted={answer.isVoted}
                                votesCount={answer.votesCount}
                            />
                        </div>
                        <div className="accept">
                            <AcceptAnswerItem answer={answer} auth={auth} />
                        </div>
                    </div>
                    <div className="media-body">
                        {answer.excerpt}
                        <div className="row">
                            <div className="col-4">{handleButtons()}</div>
                            <div className="col-4" />
                            <div className="col-4">
                                <Author answer={answer} />
                            </div>
                        </div>
                        <hr />
                    </div>
                </div>
            )}
        </>
    );
};

export default AnswerItem;
