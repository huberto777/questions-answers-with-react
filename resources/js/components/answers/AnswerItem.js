import React from "react";
import Author from "../Author";
import VoteAnswerItem from "./VoteAnswerItem";
import AcceptAnswerItem from "./AcceptAnswerItem";

const AnswerItem = ({ auth, answer, name, isVoted, isBest, votesCount }) => {
    // console.log(answer.user.id);
    const handleButtons = () => {
        if (auth.id === answer.user.id) {
            return (
                <>
                    <button
                        onClick={props.editAnswer}
                        className="btn btn-sm mr-1 btn-outline-primary"
                    >
                        <i className="far fa-edit"></i>
                    </button>
                    <button
                        className="btn btn-sm btn-outline-danger"
                        onClick={props.delete}
                    >
                        <i className="far fa-trash-alt"></i>
                    </button>
                </>
            );
        }
    };
    return (
        <>
            <div className="media post">
                <div className="d-fex flex-column vote-controls">
                    <div className="vote">
                        <VoteAnswerItem
                            auth={auth}
                            answer={answer}
                            name={name}
                            isVoted={isVoted}
                            votesCount={votesCount}
                        />
                    </div>
                    <div className="accept">
                        <AcceptAnswerItem
                            answer={answer}
                            auth={auth}
                            isBest={isBest}
                        />
                    </div>
                </div>
                <div className="media-body">
                    {answer.excerpt}
                    <div className="row">
                        <div className="col-4">{handleButtons()}</div>
                        <div className="col-4"></div>
                        <div className="col-4">
                            <Author answer={answer} />
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
        </>
    );
};

export default AnswerItem;
