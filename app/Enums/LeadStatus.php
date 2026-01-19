<?php

namespace App\Enums;

enum LeadStatus: string
{
    case LEAD = 'lead';
    case CONTACTED = 'contacted';
    case PROPOSAL_SENT = 'proposal_sent';
    case WON = 'won';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::LEAD => 'Lead',
            self::CONTACTED => 'Contacted',
            self::PROPOSAL_SENT => 'Proposal Sent',
            self::WON => 'Won',
        };
    }
}
