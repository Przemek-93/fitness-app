import React, { Component } from "react";

import { Inject, ScheduleComponent, Day, Week, WorkWeek, Month, Agenda } from '@syncfusion/ej2-react-schedule';

import "../../styles/pages/Trainings.css";

// const localizer = Calendar.momentLocalizer(moment);
// const DnDCalendar = withDragAndDrop(Calendar);

class TrainingsSchedule extends Component {
    render() {
        return (
            <ScheduleComponent>
                <Inject services={[Day, Week, WorkWeek, Month, Agenda]} />
            </ScheduleComponent>
        );
    }
}

export default TrainingsSchedule;
