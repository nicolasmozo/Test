import TicketDetails from "@/components/Sections/Profile/TicketDetails";
import React from "react";
export function generateMetadata(ctx) {
  return {
    title: `Ticket #${ctx.params.ticket}`,
  };
}
function Page(ctx) {
  return <TicketDetails ticketID={ctx.params.ticket} />;
}

export default Page;
