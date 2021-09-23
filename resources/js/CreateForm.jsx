import {
    FormControl,
    Container,
    TextField,
 } from "@mui/material";
 import LoadingButton from '@mui/lab/LoadingButton';
import React from "react";
import axios from "axios";

const CreateForm = (props) => {
    const {loading} = React.useState(false);
    const [errorMessage] = React.useState({
        summary: '',
        description: '',
        property_name: '',
    })

    const [formData] = React.useState({
        property_name: null,
        summary: null,
        description: null,
        first_name: null,
        last_name: null,
    });

    const propertyHandle = (event) => {
        console.log(event);
        formData.property_name = event.target.value;
    };

    const summaryHandle = (event) => {
        console.log(event);
        formData.summary = event.target.value;
    };

    const descriptionHandle = (event) => {
        formData.description = event.target.value;
    };

    const lastNameHandle = (event) => {
        formData.last_name = event.target.value;
    }

    const nameHandle = (event) => {
        formData.first_name = event.target.value;
    }

    const submit = (event) => {
        const url = `${process.env.MIX_APP_URL}/api/jobs`
        axios.post(url,
            formData,
        ).then((response) => {
            if(response.data.errors === undefined) {
                props.createdSuccessfully(true);
            }

            console.log(response);
            return response.data.errors;
        }).then((validErrors) => {
            const {summary, property_name, description} = validErrors;
            errorMessage.property_name = property_name;
            errorMessage.summary = summary;
            errorMessage.description = description;
        }).catch((err) => {
            alert('Server error');
        })
    }


    return (
        <Container maxWidth="sm">
            <Container maxWidth="sm">
                <FormControl sx={{ minWidth: 500 }}>
                <TextField id="outlined-basic" label="First Name" variant="outlined"
                    name="first_name"
                    required
                    onChange={nameHandle}
                    helperText={errorMessage.property_name[0]}
                    />
                    <hr />
                     <TextField id="outlined-basic" label="Last Name" variant="outlined"
                    name="last_name"
                    required
                    onChange={lastNameHandle}
                    helperText={errorMessage.property_name[0]}
                    />
                    <hr/>
                    <TextField id="outlined-basic" label="Property Name" variant="outlined"
                    name="property_name"
                    required
                    onChange={propertyHandle}
                    helperText={errorMessage.property_name[0]}
                    />
                    <hr />
                    <TextField
                        id="outlined-multiline-static"
                        label="Summary"
                        multiline
                        rows={4}
                        required
                        onChange={summaryHandle}
                        helperText={errorMessage.summary[0]}
                    />
                    <hr />
                    <TextField
                        id="outlined-multiline-static"
                        label="Description"
                        multiline
                        rows={4}
                        required
                        onChange={descriptionHandle}
                        helperText={errorMessage.description[0]}
                    />
                    <hr/>
                    <LoadingButton loading={loading} variant="outlined"
                        onClick={submit}
                    >
                        Submit
                    </LoadingButton>
                </FormControl>
            </Container>
        </Container>

    )
};

export default CreateForm;
