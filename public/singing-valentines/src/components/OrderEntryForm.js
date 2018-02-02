import React from 'react';

import TextInput from './TextInput';
import TextAreaInput from './TextAreaInput';
import DropdownInput from './DropdownInput';
import ApiHelper from '../ApiHelper';
import ErrorIndicator from './ErrorIndicator';
import SubmittedIndicator from './SubmittedIndicator';

import Order from '../types/Order';

export default class OrderEntryForm extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            location: "",
            recipient_name: "",
            sender_name: "",
            sender_email: "",
            song: "",
            day: "",
            time: "",
            comment: "",
            daysDropdownValues: props.orderContainer.getDaysDropdownValues(),
            timesDropdownValues: [],
            songsDropdownValues: props.orderContainer.getSongsDropdownValues(),
            orderContainer: {},
            errorMessage: "",
            successMessage: "",
            submitButtonDisabled: false,
        
        };
    }

    componentWillReceiveProps = (nextProps) => {
        if (nextProps.isEditingExistingOrder) {
            this.setState({
                id: nextProps.orderBeingEdited.id,
                location: nextProps.orderBeingEdited.location,
                recipient_name: nextProps.orderBeingEdited.recipient_name,
                sender_name: nextProps.orderBeingEdited.sender_name,
                sender_email: nextProps.orderBeingEdited.sender_email,
                song: nextProps.orderBeingEdited.song_id,
                day: nextProps.orderBeingEdited.timeslot.day,
                time: nextProps.orderBeingEdited.timeslot.id,
                comment: nextProps.orderBeingEdited.comment,
                daysDropdownValues: nextProps.orderContainer.getDaysDropdownValues(),
                timesDropdownValues: nextProps.orderContainer.getTimesDropdownValues(nextProps.orderBeingEdited.timeslot.day, nextProps.shouldOverrideTimeslotFull, nextProps.shouldOverrideTimeslotFull),
                songsDropdownValues: nextProps.orderContainer.getSongsDropdownValues(),
                orderContainer: nextProps.orderContainer,
                errorMessage: "",
                successMessage: "",
                submitButtonDisabled: false,
            });
        }
        else {
            this.setState({
                location: "",
                recipient_name: "",
                sender_name: "",
                sender_email: "",
                song: "",
                day: "",
                time: "",
                comment: "",
                daysDropdownValues: nextProps.orderContainer.getDaysDropdownValues(),
                timesDropdownValues: [],
                songsDropdownValues: nextProps.orderContainer.getSongsDropdownValues(),
                orderContainer: {},
                errorMessage: "",
                successMessage: "",
                submitButtonDisabled: false,
            
            });
        }
    }

    inputChanged = (event) => {
        var inputName = event.target.name;
        var inputValue = event.target.value;
        this.setState({[inputName]: inputValue});
        if (inputName === 'day') {
            this.setState({time: ""});
            this.setState({timesDropdownValues: this.props.orderContainer.getTimesDropdownValues(inputValue, this.props.shouldOverrideTimeslotFull, this.props.shouldOverrideTimeslotFull)});
        }
    }

    submitOrder = () => {
        var allFieldsFilledOut = Order.orderFormFields.every(formName => {
            return this.state[formName] !== "" || formName === 'comment';
        });
        if (!allFieldsFilledOut) {
            this.setState({errorMessage: "You must fill out all fields."});
            return;
        }
        else {
            this.setState({errorMessage: ""});
        }

        this.setState({submitButtonDisabled: true});

        if (this.props.isEditingExistingOrder) {
            ApiHelper.UpdateOrder(this.state).then(this.onOrderSubmitted).catch(this.onOrderFailed);
        }
        else {
            ApiHelper.SubmitOrder(this.state, this.state.shouldOverrideTimeslotFull).then(this.onOrderSubmitted).catch(this.onOrderFailed);
            
        }
    }

    onOrderSubmitted = (response) => {
        console.log("Order submitted:");
        console.log(response);
        if (response.error === 'timeslot full') {
            this.setState({errorMessage: "Failed to submit order, that timeslot is now full. Either choose a different timeslot, or refresh the page to update available ones."});
            this.setState({submitButtonDisabled: false});
            return;
        }

        if (this.props.isEditingExistingOrder) {
            this.setState({successMessage: "The order was updated successfully! Refresh the page to see the changes."});
        }
        else {
            this.setState({successMessage: "Your order was successfully submitted! Refresh the page to make a new order."});
            
        }
    }

    onOrderFailed = (response) => {
        console.log("Order failed:");
        console.error(response);
        this.setState({errorMessage: "Failed to submit order, your session may have expired. Try refreshing the page."});
        this.setState({submitButtonDisabled: false});
    }

    render() {
        if (this.props.isHidden) {
            return null;
        }

        return (
            <div className="row">
                <div className="col-md-12">
                    <form className="form-horizontal">

                        <TextInput 
                            formName="recipient_name" 
                            value={this.state.recipient_name}
                            onChange={this.inputChanged}>
                        </TextInput>

                        <TextInput 
                            formName="sender_name"
                            value={this.state.sender_name}
                            onChange={this.inputChanged}>
                        </TextInput>

                        <TextInput 
                            formName="sender_email"
                            value={this.state.sender_email}
                            onChange={this.inputChanged}>
                        </TextInput>

                        <DropdownInput
                            formName="day"
                            value={this.state.day}
                            onChange={this.inputChanged}
                            dropdownValues={this.state.daysDropdownValues}>
                        </DropdownInput>

                        <DropdownInput
                            formName="time"
                            value={this.state.time}
                            onChange={this.inputChanged}
                            dropdownValues={this.state.timesDropdownValues}>
                        </DropdownInput>

                        <TextInput 
                            formName="location"
                            value={this.state.location}
                            onChange={this.inputChanged}>
                        </TextInput>

                        <DropdownInput
                            formName="song"
                            value={this.state.song}
                            onChange={this.inputChanged}
                            dropdownValues={this.state.songsDropdownValues}>
                        </DropdownInput>

                        <TextAreaInput 
                            formName="comment"
                            value={this.state.comment}
                            onChange={this.inputChanged}>
                        </TextAreaInput>

                        <ErrorIndicator
                            errorMessage={this.state.errorMessage}>
                        </ErrorIndicator>

                        <SubmittedIndicator
                            successMessage={this.state.successMessage}>
                        </SubmittedIndicator>

                        <div className="col-md-6 col-md-offset-3">
                            <button 
                                onClick={this.submitOrder}
                                disabled={this.state.submitButtonDisabled}
                                type="button" 
                                className="btn btn-block btn-primary">
                                <span>{this.props.isEditingExistingOrder ? "Update Order" : "Submit Order"}</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        );
    }
}