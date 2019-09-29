<script type="text/babel">
    const Favorite  = props => {
        let classes ="favorite mt-2";
        if(props.auth) classes += " off";
        if(props.isFavorited) classes += " favorited";
        // console.log(props.isFavorited);
        return (
            <>
                <a title={`click to mark as favorite ${name} (click again to undo)`} className={classes} onClick={props.isFavorited ? props.unfavorite : props.favorite}>
                    <i className="fas fa-star fa-2x"></i>
                    <span className="favorites-count">{ props.count }</span>
                </a>
            </>
        )
    }

    class Vote extends React.Component {
        constructor(props) {
            super(props);
            this.state = {
                auth: props.auth ? JSON.parse(props.auth) : null,
                question: JSON.parse(props.question),
                votesCount: JSON.parse(props.votesCount),
                isFavorited: props.isFavorited,
                count: JSON.parse(props.count),
                active: props.isVoted,
            };
            // console.log(this.state.question);
            // console.log(this.state.active);
        }
        handleVoteUp = e => {
            e.preventDefault();
            if(!this.state.auth) return alert('zaloguj się');;
            this.setState({
                votesCount: this.state.votesCount + 1,
                active: !this.state.active
            })
            axios.post(`/vote/${this.state.question.id}/Question`)
                .then(res => res.data)
                .catch(err => console.log(err));
        }
        handleVoteDown = e => {
            e.preventDefault();
            if(!this.state.auth) return alert('zaloguj się');

            this.setState({
                votesCount: this.state.votesCount - 1,
                active: !this.state.active
            })
            axios.delete(`/unvote/${this.state.question.id}/Question`)
                .then(res => res.data)
                .catch(err => console.log(err));
        }
        handleFavorite = e => {
            e.preventDefault();
            if(!this.state.auth) return alert('zaloguj się');
            this.setState({
                isFavorited: !this.state.isFavorited,
                count: this.state.count + 1
            })
            axios.post(`/questions/${this.state.question.slug}/favorites`)
                .then(res => res.data)
                .catch(error => console.log(error));
        }
        handleUnFavorite = e => {
            e.preventDefault();
            if(!this.state.auth) return alert('zaloguj się');
            this.setState({
                isFavorited: !this.state.isFavorited,
                count: this.state.count - 1
            })
            axios.delete(`/questions/${this.state.question.slug}/favorites`)
                .then(res => res.data)
                .catch(error => console.log(error));
        }

        render() {
            const {auth, question, votesCount, isFavorited, count } = this.state;
            const {name} = this.props;
            const classes = ['vote-up'];
            if(auth) classes.push(' off');
            return (
                <>
                    <div className="d-fex flex-column vote-controls">
                        <button disabled={this.state.active || !auth} title={`This ${ name } is useful`} className={classes.join(" ")} onClick={this.handleVoteUp} >
                            <i className="fas fa-caret-up fa-3x"></i>
                        </button>

                        <span className="votes-count">{ votesCount }</span>

                        <button disabled={!this.state.active}  title={`This ${name} is not useful`} className={classes.join(" ")}  onClick={this.handleVoteDown} >
                            <i className="fas fa-caret-down fa-3x" ></i >
                        </button>

                        <Favorite
                            name={name}
                            auth={auth}
                            count={count}
                            isFavorited={isFavorited}
                            favorite={this.handleFavorite}
                            unfavorite={this.handleUnFavorite}
                        />
                    </div>
                </>
            )
        }
    };
    let question = document.getElementById('voteQuestion').getAttribute('question');
    let name = document.getElementById('voteQuestion').getAttribute('name');
    let auth = document.getElementById('voteQuestion').getAttribute('auth');
    let votesCount = document.getElementById('voteQuestion').getAttribute('votesCount');
    let isFavorited = document.getElementById('voteQuestion').getAttribute('isFavorited');
    let isVoted = document.getElementById('voteQuestion').getAttribute('isVoted');
    let count = document.getElementById('voteQuestion').getAttribute('count');

    ReactDOM.render(<Vote question={question} name={name} auth={auth} votesCount={votesCount} isFavorited={isFavorited} count={count} isVoted={isVoted} />, document.getElementById('voteQuestion'));
</script>
