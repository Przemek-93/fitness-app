import React, { Component } from "react";
import { Inject, ScheduleComponent, Day, Week, WorkWeek, Month, Agenda } from '@syncfusion/ej2-react-schedule';
import {createUrl, removeUrl} from "../../utils/apiUrl";
import "../../styles/pages/Trainings.css";

class TrainingsSchedule extends Component {
    onActionComplete(args) {
        console.log(args);
        switch (args.requestType) {
            case "eventCreated":
                return this.onEventCreated(args.addedRecords);
            case "eventRemoved":
                return  this.onEventRemoved(args.deletedRecords);
        }
    }

    onEventCreated(eventData) {
        let firstElement = eventData[0];
        fetch(createUrl, {
            method: 'post',
            headers: new Headers({
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': sessionStorage.getItem('token')
            }),
            body: JSON.stringify({
                "internalId": firstElement.Id,
                "subject": firstElement.Subject,
                "startTime": this.parseDate(firstElement.StartTime),
                "endTime": this.parseDate(firstElement.EndTime),
                "isAllDay": firstElement.IsAllDay
            })
        })
    }

    parseDate(date) {
        return new Date(date.getTime() - (date.getTimezoneOffset() * 60000 ))
                .toISOString()
                .split("T")[0]
            + "T" + ("0" + date.getHours()).slice(-2) + ":"
            + ("0" + date.getMinutes()).slice(-2) + ":"
            + ("0" + date.getSeconds()).slice(-2) + "Z"
    }

    onEventRemoved(eventData) {
        console.log(eventData);
    }

    render() {
        return (
            <ScheduleComponent actionComplete={this.onActionComplete.bind(this)} dateFormat="yyyy/mm/dd">
                <Inject services={[Day, Week, WorkWeek, Month, Agenda]} />
            </ScheduleComponent>
        );
    }
}

export default TrainingsSchedule;
