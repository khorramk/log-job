import CustomPaginationActionsTable from './Table';
import React from 'react';
import axios from 'axios';
import ReactLoading from 'react-loading';
import Link from '@mui/material/Link';
import { Button, Container, Grid } from '@mui/material';
import CreateForm from './CreateForm';

export default class App extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            jobs: [],
            createJobs: false,
            jobCreated: true,
        };
        console.log(this.state.jobCreated);
    }
    componentDidMount() {
        const self = this;
        axios.get(`${process.env.MIX_APP_URL}/api/jobs`)
            .then((response) => {
                if (response.data.length === 0) {
                    return [];
                }
                return response.data;
            }).then((data) => {
                self.setState({
                    jobs: data
                });
            })
            .catch((err) => console.log(err));
    }

    handle() {
        this.setState({
            createJobs: true,
            jobCreated: false,
        })
    }

    render() {
        if (this.state.jobs.length === 0) {
            return (
                <div className="container">
                    <div className="row justify-content-center">
                        <ReactLoading
                            type={'spin'}
                            color={'blue'}
                            height={'20%'}
                            width={'20%'} />
                    </div>
                </div>
            )
        }

        if (this.state.createJobs && !this.state.jobCreated) {
            return (<CreateForm createdSuccessfully={(success) => {
                this.setState({
                    jobCreated: success,
                });
            }}/>)
        }

        return (
            <Container maxWidth="sm">
                <Container maxWidth="sm">
                    <div className="row justify-content-end">
                        <div className="col-sm-3 text-white">
                            <Button onClick={this.handle.bind(this)}>Add Jobs</Button>
                        </div>
                    </div>
                </Container>
                <CustomPaginationActionsTable jobs={this.state.jobs} />
            </Container>
        )
    }
}

