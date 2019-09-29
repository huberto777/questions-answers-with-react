import React from "react";
import AnswerItem from "./AnswerItem";
import EditAnswer from "./EditAnswer";
import Axios from "axios";

class AnswerList extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            answers: JSON.parse(props.answers) || null,
            auth: JSON.parse(props.auth) || null,
            edit: false,
            count: JSON.parse(props.count),
            question: JSON.parse(props.question),
            id: null
        };
        this.handleEditAnswer = this.handleEditAnswer.bind(this);
        // console.log(this.state.answers[0]);
        // console.log(this.state.answers[0].is_best);
        // console.log(this.state.answers);
        // console.log(this.state.auth.avatar);
    }

    handleEditAnswer() {
        // console.log(arguments);
        this.setState({
            edit: !this.state.edit,
            id: arguments[0],
            body: arguments[1]
        });
    }

    updateAnswer = e => {
        e.preventDefault();
        // console.log(event.target.updateAnswer.value);
        if (e.target.updateAnswer.value < 3) return;
        this.setState({
            answers: this.state.answers.map(answer => {
                if (answer.id === this.state.id) {
                    answer.excerpt = e.target.updateAnswer.value;
                    // console.log(answer);
                }
                return answer;
            }),
            edit: false
        });
        Axios.put(
            `/questions/${this.state.question.slug}/answers/${this.state.id}`,
            {
                body: e.target.updateAnswer.value
            }
        )
            .then(res => res.data)
            .catch(err => console.log(err));
    };

    handleDeleteAnswer = id => {
        const answers = [...this.state.answers];
        const index = answers.findIndex(answer => answer.id === id);
        answers.splice(index, 1);
        this.setState({
            answers,
            count: this.state.count - 1
        });
        if (!this.state.auth) return alert("zaloguj się");

        Axios.delete(`/questions/${this.state.question.slug}/answers/${id}`)
            .then(res => res.data)
            .catch(error => console.log(error));
    };

    createButton() {
        if (!this.state.auth) return "";
        if (!this.state.edit) {
            return (
                <a
                    href={`/questions/${this.state.question.slug}/answers/create`}
                    className="btn btn-block btn-outline-secondary mb-4"
                >
                    dodaj
                </a>
            );
        }
    }

    render() {
        const { answers, auth, count, create, question } = this.state;
        const { name } = this.props;
        let classes = "btn btn-block mb-4";
        if (!create) classes += " btn-outline-secondary";
        if (create) classes += " btn-outline-danger";
        return (
            <>
                {this.state.edit ? (
                    <>
                        <EditAnswer
                            editAnswer={this.handleEditAnswer}
                            body={this.state.body}
                            updateAnswer={this.updateAnswer}
                        />
                    </>
                ) : (
                    this.createButton()
                )}
                <div className="card-title">
                    <h3>
                        {count} {name}s
                    </h3>
                </div>
                <hr />

                {answers.map(answer => (
                    <AnswerItem
                        key={answer.id}
                        answer={answer}
                        auth={auth}
                        name={name}
                        isVoted={answer.is_voted}
                        isBest={answer.is_best}
                        votesCount={answer.votes_count}
                        delete={this.handleDeleteAnswer}
                        editAnswer={this.handleEditAnswer}
                    />
                ))}
            </>
        );
    }
}
let answers = document.getElementById("answers").getAttribute("answers");
let auth = document.getElementById("answers").getAttribute("auth");
let name = document.getElementById("answers").getAttribute("name");
let count = document.getElementById("answers").getAttribute("count");
let question = document.getElementById("answers").getAttribute("question");

ReactDOM.render(
    <AnswerList
        answers={answers}
        auth={auth}
        name={name}
        count={count}
        question={question}
    />,
    document.getElementById("answers")
);

export default AnswerList;
