<?php declare(strict_types=1);

namespace App\Command;

use chillerlan\QRCode\Output\QROutputInterface;
use chillerlan\QRCode\Output\QRStringText;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command to show the TOTP QR code.
 *
 * @since 2024.02.27
 */
#[AsCommand(name: 'totp:qr-code', description: 'Show the QR code for the TOTP secret.')]
class TotpQrCodeCommand extends Command
{
    /**
     * Set all needed parameters.
     *
     * @param string $totp_secret
     */
    public function __construct(private readonly string $totp_secret)
    {
        parent::__construct();
    }

    /**
     */
    #[\Override]
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$this->totp_secret) {
            $output->writeln('Please generate a TOTP secret first with totp:generate-secret.');

            return Command::FAILURE;
        }

        $options = new QROptions();

        $options->outputType = QROutputInterface::STRING_TEXT;
        $options->outputInterface = QRStringText::class;
        $options->version = 7;
        $options->eol = "\n";
        $options->addQuietzone = false;
        // default values for unassigned module types
        $options->textDark = QRStringText::ansi8('██', 253);
        $options->textLight = QRStringText::ansi8('░░', 253);

        $data = sprintf('otpauth://totp/%s?secret=%s', 'holloway-web.de',
            $this->totp_secret);
        $output->writeln((new QRCode($options))->render($data));

        return Command::SUCCESS;
    }
}
