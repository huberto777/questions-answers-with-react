import React, { Component } from "react";
import AcceptAnswerItem from "./AcceptAnswerItem.js";
import axios from "axios";

class VoteAnswerItem extends Component {
    constructor(props) {
        super(props);
        this.state = {
            active: props.isVoted,
            votesCount: props.votesCount,
        };
        // console.log(this.state.answer);
    }
    handleVoteUp = (e) => {
        e.preventDefault();
        if (!this.props.auth) return alert("zaloguj się");
        this.setState((prevState) => ({
            active: !prevState.active,
            votesCount: prevState.votesCount + 1,
        }));
        axios
            .post(`/vote/${this.props.answer.id}/Answer`)
            .then((res) => res.data)
            .catch((err) => console.log(err));
    };
    handleVoteDown = (e) => {
        e.preventDefault();
        if (!this.props.auth) return alert("zaloguj się");
        this.setState((prevState) => ({
            active: !prevState.active,
            votesCount: prevState.votesCount - 1,
        }));
        axios
            .delete(`/unvote/${this.props.answer.id}/Answer`)
            .then((res) => res.data)
            .catch((err) => console.log(err));
    };
    render() {
        const { active, votesCount } = this.state;
        const { name, auth } = this.props;
        let classes = "vote-up";
        if (auth) classes += " off";
        return (
            <>
                <button
                    disabled={active || !auth}
                    title={`This ${name} is useful`}
                    className={classes}
                    onClick={this.handleVoteUp}
                >
                    <i className="fas fa-caret-up fa-3x"></i>
                </button>
                <span className="votes-count">{votesCount}</span>
                <button
                    disabled={!active}
                    title={`This ${name} is not useful`}
                    className={classes}
                    onClick={this.handleVoteDown}
                >
                    <i className="fas fa-caret-down fa-3x"></i>
                </button>
            </>
        );
    }
}

export default VoteAnswerItem;
