import React, { Component } from "react";
import axios from "axios";

class AcceptAnswerItem extends Component {
    constructor(props) {
        super(props);
        this.state = {
            answer: props.answer
        };
    }

    handleAccept = e => {
        if (!this.props.auth) return alert("zaloguj się");
        this.setState(prevState => ({
            answer: !prevState.answer.isBest
        }));
        axios
            .post(`/answers/${this.props.answer.id}/accept`)
            .then(res => res.data)
            .catch(err => console.log(err));
    };
    renderView = () => {
        let classes = "";
        const { isBest } = this.state.answer;
        if (isBest) classes += "vote-accepted";
        if (isBest) {
            return (
                <a
                    title="the question owner accepted this answer as best answer"
                    className={classes}
                    onClick={this.handleAccept}
                >
                    <i className="fas fa-check fa-2x" />
                </a>
            );
        } else {
            return (
                <a
                    title="mark this answer as best answer"
                    className={classes}
                    onClick={this.handleAccept}
                >
                    <i className="fas fa-check fa-2x" />
                </a>
            );
        }
    };

    render() {
        return (
            <>
                {this.renderView()}
                {/* to do policy */}
            </>
        );
    }
}

export default AcceptAnswerItem;
