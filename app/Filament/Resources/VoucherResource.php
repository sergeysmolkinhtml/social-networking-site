<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoucherResource\Pages;
use App\Filament\Resources\VoucherResource\RelationManagers;
use App\Models\Voucher;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VoucherResource extends Resource
{
    protected static ?string $model = Voucher::class;

    protected static ?string $navigationIcon = 'heroicon-o-qrcode';

    protected static ?string $recordTitleAttribute = 'code';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Shop';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->unique(),
                Forms\Components\TextInput::make('discount_percent')
                    ->label('Discount (%)')
                    ->numeric()
                    ->default(10)
                    ->extraInputAttributes(['min' => 1, 'max' => 100 ,'step' => 1]),
                Select::make('product_id')
                    ->relationship('product','name')
                    ->label('Product name')


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('discount_percent')->label('Discount (%)'),
                Tables\Columns\TextColumn::make('product.name')->label('Product name'),
                Tables\Columns\TextColumn::make('payments_count')
                    ->counts('payments')
                    ->label('Times used'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageVouchers::route('/'),
            /*'create' => Pages\CreateVoucher::route('/create'),
            'edit' => Pages\EditVoucher::route('/{record}/edit'),*/
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return self::getModel()::count();
    }
}
