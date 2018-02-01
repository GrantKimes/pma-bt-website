import React from 'react';


export default class DayAndTimeslotFilter extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            day: "",
            time: "",
            timesDropdownValues: [],
        }
    }

    componentDidMount() {
    }

    toOptionFields(dropdownValues) {
        console.log(dropdownValues);
        return dropdownValues.map( (value, index) => <option key={index} value={value.value}>{value.readable}</option>);
    }

    inputChanged = (event) => {
        let inputName = event.target.name;
        let inputValue = event.target.value;
        var stateUpdates = {[inputName]: inputValue};
        if (inputName === 'day') {
            stateUpdates.time =  "";
            let includeNumberOfOrders = true;
            stateUpdates.timesDropdownValues = this.props.orderContainer.getTimesDropdownValues(inputValue, includeNumberOfOrders);
        }
        this.setState(stateUpdates, () => {
            this.props.onChange(this.state.day, this.state.time);
        })
    }

    render() {
        let daysOptionFields = this.toOptionFields(this.props.daysDropdownValues);
        let timesOptionFields = this.toOptionFields(this.state.timesDropdownValues);

        return (
        	<div className="container">
                <div className="row">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-info">
                            <div className="panel-heading">
                                <h3 className="panel-title">View Orders</h3>
                            </div>
                            <div className="panel-body">
                                <div className="col-md-3 col-xs-6">
                                    <select 
                                        name="day" 
                                        value={this.state.day}
                                        onChange={this.inputChanged}
                                        className="form-control" 
                                    >
                                        <option value="">All days</option>
                                        {daysOptionFields}
                                    </select>
                                </div>

                                <div className="col-md-3 col-xs-6">
                                    <select 
                                        name="time" 
                                        value={this.state.time}
                                        onChange={this.inputChanged}
                                        className="form-control" 
                                    >
                                        <option value="">All times</option>
                                        {timesOptionFields}
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}