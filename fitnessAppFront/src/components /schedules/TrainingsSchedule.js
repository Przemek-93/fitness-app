import React, { Component } from "react";
import {Calendar} from "react-big-calendar";
import moment from "moment";
import withDragAndDrop from "react-big-calendar/lib/addons/dragAndDrop";

import "../../styles/pages/Trainings.css";

// const localizer = Calendar.momentLocalizer(moment);
// const DnDCalendar = withDragAndDrop(Calendar);

class TrainingsSchedule extends Component {
    // state = {
    //     events: [
    //         {
    //             start: new Date(),
    //             end: new Date(moment().add(1, "days")),
    //             title: "Some title"
    //         }
    //     ]
    // };
    //
    // onEventResize = (type, { event, start, end, allDay }) => {
    //     this.setState(state => {
    //         state.events[0].start = start;
    //         state.events[0].end = end;
    //         return { events: state.events };
    //     });
    // };

    // onEventDrop = ({ event, start, end, allDay }) => {
    //     console.log(start);
    // };

    render() {
        return (
            <div>
                {/*<DnDCalendar*/}
                {/*    defaultDate={new Date()}*/}
                {/*    defaultView="month"*/}
                {/*    events={this.state.events}*/}
                {/*    localizer={localizer}*/}
                {/*    onEventDrop={this.onEventDrop}*/}
                {/*    onEventResize={this.onEventResize}*/}
                {/*    resizable*/}
                {/*    style={{ height: "100vh" }}*/}
                {/*/>*/}
            </div>
        );
    }
}

export default TrainingsSchedule;
